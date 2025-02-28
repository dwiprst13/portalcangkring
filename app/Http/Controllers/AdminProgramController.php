<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.program.index', [
            'programs'  => Program::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto'      => 'required|mimes:jpeg,jpg,png',
            'program'   =>  ucwords(strtolower($request->program)),
            'slug'      => 'required|unique:programs',
            'deskripsi' => 'required'
        ], [
            'foto.required'         => 'Wajib menambahkan foto !',
            'foto.mimes'            => 'Format foto yang di izinkan Jpeg, Jpg, Png',
            'program.required'       => 'Wajib menambahkan nama program !',
            'slug.required'         => 'Slug tidak boleh kosong !',
            'slug.unique'           => 'Slug tidak boleh sama !',
            'deskripsi.required'    => 'Wajib menambahkan deskripsi program !'
        ]);

        if ($request->hasFile('foto')) {
            $path       = 'img-program/';
            $file       = $request->file('foto');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid() . '.' . $extension;
            $foto     = $file->storeAs($path, $fileName, 'public');
        } else {
            $foto     = null;
        }

        if ($validator->fails()) {
            return redirect('/admin/program/create')
                ->withErrors($validator)
                ->withInput();
        }

        Program::create([
            'foto'          =>  $path . $fileName,
            'program'        =>  $request->program,
            'slug'          =>  $request->slug,
            'no_hp'         =>  $request->no_hp,
            'deskripsi'     =>  $request->deskripsi,
            'user_id'       =>  auth()->user()->id,
        ]);

        return redirect('/admin/program')->with('success', 'Berhasil menambahkan data program');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $program = Program::find($id);
        return view('admin.program.edit', [
            'program'  => $program
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $program = Program::find($id);
        $validator = Validator::make($request->all(), [
            'program'    => 'required',
            'slug'      => 'required',
            // 'harga'     => 'required|numeric',
            'no_hp'     => 'required|numeric',
            'deskripsi' => 'required'
        ], [
            'program.required'       => 'Wajib menambahkan nama program !',
            'slug.required'         => 'Slug tidak boleh kosong !',
            'harga.required'        => 'Wajib menambahkan harga !',
            // 'harga.numeric'         => 'Tambahkan format angka !',
            'no_hp.required'        => 'Wajib menambahkan No Hp !',
            'no_hp.numeric'         => 'Tambahkan format angka !',
            'deskripsi.required'    => 'Wajib menambahkan deskripsi program !'
        ]);

        if ($request->slug != $program->slug) {
            $program->slug  = 'required|unique:programs';
        }

        if ($request->hasFile('foto')) {
            if ($program->foto) {
                unlink('.' . Storage::url($program->foto));
            }
            $path       = 'img-program/';
            $file       = $request->file('foto');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid() . '.' . $extension;
            $foto     = $file->storeAs($path, $fileName, 'public');
        } else {
            $validator = Validator::make($request->all(), [
                'program'    => 'required',
                'slug'      => 'required',
                // 'harga'     => 'required|numeric',
                'no_hp'     => 'required|numeric',
                'deskripsi' => 'required'
            ], [
                'program.required'       => 'Wajib menambahkan nama program !',
                'slug.required'         => 'Slug tidak boleh kosong !',
                'harga.required'        => 'Wajib menambahkan harga !',
                // 'harga.numeric'         => 'Tambahkan format angka !',
                'no_hp.required'        => 'Wajib menambahkan No Hp !',
                'no_hp.numeric'         => 'Tambahkan format angka !',
                'deskripsi.required'    => 'Wajib menambahkan deskripsi program !'
            ]);
            $foto = $program->foto;
        }
        if ($validator->fails()) {
            return redirect("/admin/program/{$program->id}/edit")
                ->withErrors($validator)
                ->withInput();
        };

        $program->update([
            'foto'          => $foto,
            'program'        => $request->program,
            'slug'          => $request->slug,
            // 'harga'         => $request->harga,
            'no_hp'         => $request->no_hp,
            'deskripsi'     => $request->deskripsi,
            'excerpt'       => Str::limit(strip_tags($request->body), 100),
            'user_id'       => auth()->user()->id,
        ]);

        return redirect('/admin/program')->with('success', 'Berhasil memperbarui program program');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $program = Program::find($id);
        unlink('.' . Storage::url($program->foto));
        $program->delete();

        return redirect('/admin/program')->with('success', 'Berhasil menghapus program program');
    }

    /**
     * Generate slug / permalink by Produk.
     */
    public function slug(Request $request)
    {
        $slug = SlugService::createSlug(Program::class, 'slug', $request->program);
        return response()->json(['slug' => $slug]);
    }
}
