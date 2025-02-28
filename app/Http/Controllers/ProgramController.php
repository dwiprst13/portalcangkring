<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
        return view('program.index', [
            'programs'     => Program::orderBy('id', 'DESC')->paginate(9)
        ]);
    }

    public function detail($slug)
    {
        $program   = Program::where('slug', $slug)->first();
        return view('program.detail', [
            'program'  => $program
        ]);
    }
}
