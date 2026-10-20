<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        // Le premier slide actif pilote le hero de l'accueil (éditable depuis le back-office « Slides »).
        $hero = Slide::active()->ordered()->first();
        $testimonials = \App\Models\Testimonial::active()->ordered()->limit(6)->get();
        $services = Service::active()->ordered()->limit(6)->get();
        $realisations = \App\Models\Realisation::active()->ordered()->limit(3)->get();
        $stats = \App\Models\Stat::active()->ordered()->get();
        $pillars = \App\Models\ContentBlock::active()->zone('home_pillar')->ordered()->get();
        $methodSteps = \App\Models\ContentBlock::active()->zone('home_method')->ordered()->get();

        return view('home', compact('hero', 'testimonials', 'services', 'realisations', 'stats', 'pillars', 'methodSteps'));
    }
}
