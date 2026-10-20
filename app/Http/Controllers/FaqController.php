<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ page
     */
    public function index()
    {
        $faqs = Faq::active()->ordered()->get();
        
        // Grouper par catégorie
        $faqsByCategory = $faqs->groupBy('category');
        
        return view('faq', compact('faqs', 'faqsByCategory'));
    }
}
