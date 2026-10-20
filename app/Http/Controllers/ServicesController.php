<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();
        $why = \App\Models\ContentBlock::active()->zone('services_why')->ordered()->get();

        return view('services', compact('services', 'why'));
    }
}
