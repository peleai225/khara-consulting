<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Slide::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('badge_text', 'like', "%{$search}%");
            });
        }
        $slides = $query->orderBy('order')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:255',
            'button_link_2' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'background_position' => 'nullable|string|in:center,center right,center left,top,bottom',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('slides', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['background_position'] = $validated['background_position'] ?? 'center';

        Slide::create($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slide $slide)
    {
        return view('admin.slides.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slide $slide)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:255',
            'button_link_2' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'background_position' => 'nullable|string|in:center,center right,center left,top,bottom',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }
            $validated['image'] = $request->file('image')->store('slides', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['background_position'] = $validated['background_position'] ?? 'center';

        $slide->update($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide mis à jour avec succès.');
    }

    /**
     * Toggle slide active status.
     */
    public function toggle(Slide $slide)
    {
        $slide->update(['is_active' => !$slide->is_active]);
        return redirect()->back()->with('success', $slide->is_active ? 'Slide publié.' : 'Slide mis en brouillon.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        // Supprimer l'image
        if ($slide->image && Storage::disk('public')->exists($slide->image)) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide supprimé avec succès.');
    }
}
