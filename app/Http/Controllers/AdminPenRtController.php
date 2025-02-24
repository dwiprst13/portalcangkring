<?php

namespace App\Http\Controllers;

use App\Models\PenRt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminPenRtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.penrt.index', [
            'penrts'    => PenRt::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penrt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penrt' => 'required',
            'jumlah'    => 'required|nume ric'
        ], [
            'penrt.required'      => 'Form jumlah warga tidak boleh kosong !',
            'jumlah'              => 'Form jumlah tidak boleh kosong !',
            'jumlah.numeric'      => 'Format yang diijinkan adalah angka !'
        ]);

        if($validator->fails()){
            return redirect('/admin/penrt/create')
                ->withErrors($validator)
                ->withInput();
        }

        PenRt::create([
            'penrt'  => $request->penrt,
            'jumlah'     => $request->jumlah,
            'user_id'    => auth()->user()->id
        ]);
        
        return redirect('/admin/penrt')->with('success', 'Berhasil menambahkan data jumlah warga');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penrt = PenRt::find($id);
        return view('admin.penrt.edit', [
            'penrt'  => $penrt
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penrt = PenRt::find($id);
        $validator = Validator::make($request->all(), [
            'penrt' => 'required',
            'jumlah'    => 'required|nume ric'
        ], [
            'penrt.required'  => 'Form jumlah warga tidak boleh kosong !',
            'jumlah'              => 'Form jumlah jumlah tidak boleh kosong !',
            'jumlah.numeric'      => 'Format yang diijinkan adalah angka !'
        ]);

        if($validator->fails()){
            return redirect('/admin/penrt/' . $penrt->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $penrt->update([
            'penrt'  => $request->penrt,
            'jumlah'    => $request->jumlah,
        ]);

        return redirect('/admin/penrt')->with('success', 'Berhasil mengedit data jumlah warga !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penrt = PenRt::find($id);
        $penrt->delete();
        return redirect('/admin/penrt')->with('success', 'Berhasil menghapus data jumlah warga !');
    }
}
