<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramsController extends Controller
{
    public function index()
    {
        $domaines = Program::active()->category('domaine')->ordered()->get();
        $formats = Program::active()->category('format')->ordered()->get();

        return view('programs', compact('domaines', 'formats'));
    }
}
