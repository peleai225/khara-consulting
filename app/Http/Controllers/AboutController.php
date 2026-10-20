<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('about');
        $team = \App\Models\TeamMember::active()->ordered()->get();

        return view('about', compact('page', 'team'));
    }
}
