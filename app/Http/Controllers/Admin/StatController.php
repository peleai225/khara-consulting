<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stat::ordered()->paginate(30);
        return view('admin.stats.index', compact('stats'));
    }

    public function create()
    {
        return view('admin.stats.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');
        Stat::create($data);

        return redirect()->route('admin.stats.index')->with('success', 'Chiffre clé ajouté.');
    }

    public function edit(Stat $stat)
    {
        return view('admin.stats.edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');
        $stat->update($data);

        return redirect()->route('admin.stats.index')->with('success', 'Chiffre clé mis à jour.');
    }

    public function toggle(Stat $stat)
    {
        $stat->update(['is_active' => ! $stat->is_active]);
        return back()->with('success', $stat->is_active ? 'Chiffre affiché.' : 'Chiffre masqué.');
    }

    public function destroy(Stat $stat)
    {
        $stat->delete();
        return redirect()->route('admin.stats.index')->with('success', 'Chiffre supprimé.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);
    }
}
