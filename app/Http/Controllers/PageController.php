<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::findBySlug($slug);
        abort_if(! $page, 404);

        return view('page', compact('page'));
    }
}
