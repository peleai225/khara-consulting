<?php

namespace App\Http\Controllers;

use App\Models\Realisation;

class RealisationsController extends Controller
{
    public function index()
    {
        $realisations = Realisation::active()->ordered()->get();

        return view('realisations', compact('realisations'));
    }
}
