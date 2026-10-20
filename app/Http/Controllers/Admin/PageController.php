<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }
        $pages = $query->orderBy('slug')->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:pages,slug',
            'title' => 'required|string|max:255',
            'hero_title' => 'nullable|string',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|max:5120',
            'content' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }

        // Convertir values en JSON si c'est une chaîne
        if (isset($validated['values']) && is_string($validated['values'])) {
            $valuesArray = array_filter(array_map('trim', explode(',', $validated['values'])));
            $validated['values'] = !empty($valuesArray) ? $valuesArray : null;
        }

        $validated['is_active'] = $request->has('is_active');

        Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'title' => 'required|string|max:255',
            'hero_title' => 'nullable|string',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|max:5120',
            'content' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('hero_image')) {
            // Supprimer l'ancienne image
            if ($page->hero_image && Storage::disk('public')->exists($page->hero_image)) {
                Storage::disk('public')->delete($page->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }

        // Convertir values en JSON si c'est une chaîne
        if (isset($validated['values']) && is_string($validated['values'])) {
            $valuesArray = array_filter(array_map('trim', explode(',', $validated['values'])));
            $validated['values'] = !empty($valuesArray) ? $valuesArray : null;
        }

        $validated['is_active'] = $request->has('is_active');

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page mise à jour avec succès.');
    }

    /**
     * Toggle page active status.
     */
    public function toggle(Page $page)
    {
        $page->update(['is_active' => !$page->is_active]);
        return redirect()->back()->with('success', $page->is_active ? 'Page publiée.' : 'Page mise en brouillon.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        // Supprimer l'image
        if ($page->hero_image && Storage::disk('public')->exists($page->hero_image)) {
            Storage::disk('public')->delete($page->hero_image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page supprimée avec succès.');
    }
}
