<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RealisationController extends Controller
{
    public function index(Request $request)
    {
        $query = Realisation::query();
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn ($q) => $q->where('title', 'like', "%{$s}%")->orWhere('sector', 'like', "%{$s}%"));
        }
        $realisations = $query->ordered()->paginate(15)->withQueryString();

        return view('admin.realisations.index', compact('realisations'));
    }

    public function create()
    {
        return view('admin.realisations.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('realisations', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');
        Realisation::create($data);

        return redirect()->route('admin.realisations.index')->with('success', 'Réalisation créée avec succès.');
    }

    public function show(Realisation $realisation)
    {
        return view('admin.realisations.show', compact('realisation'));
    }

    public function edit(Realisation $realisation)
    {
        return view('admin.realisations.edit', compact('realisation'));
    }

    public function update(Request $request, Realisation $realisation)
    {
        $data = $this->validateData($request, $realisation);
        if ($request->hasFile('image')) {
            if ($realisation->image && Storage::disk('public')->exists($realisation->image)) {
                Storage::disk('public')->delete($realisation->image);
            }
            $data['image'] = $request->file('image')->store('realisations', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');
        $realisation->update($data);

        return redirect()->route('admin.realisations.index')->with('success', 'Réalisation mise à jour avec succès.');
    }

    public function toggle(Realisation $realisation)
    {
        $realisation->update(['is_active' => ! $realisation->is_active]);

        return back()->with('success', $realisation->is_active ? 'Réalisation publiée.' : 'Réalisation masquée.');
    }

    public function destroy(Realisation $realisation)
    {
        if ($realisation->image && Storage::disk('public')->exists($realisation->image)) {
            Storage::disk('public')->delete($realisation->image);
        }
        $realisation->delete();

        return redirect()->route('admin.realisations.index')->with('success', 'Réalisation supprimée.');
    }

    private function validateData(Request $request, ?Realisation $realisation = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('realisations', 'slug')->ignore($realisation?->id)],
            'sector' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'result' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
        ]);
    }
}
