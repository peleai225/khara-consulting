<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContentBlockController extends Controller
{
    public function index()
    {
        $blocks = ContentBlock::orderBy('zone')->orderBy('order')->get()->groupBy('zone');
        return view('admin.blocks.index', compact('blocks'));
    }

    public function create()
    {
        return view('admin.blocks.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');
        ContentBlock::create($data);

        return redirect()->route('admin.blocks.index')->with('success', 'Bloc créé.');
    }

    public function edit(ContentBlock $block)
    {
        return view('admin.blocks.edit', compact('block'));
    }

    public function update(Request $request, ContentBlock $block)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');
        $block->update($data);

        return redirect()->route('admin.blocks.index')->with('success', 'Bloc mis à jour.');
    }

    public function toggle(ContentBlock $block)
    {
        $block->update(['is_active' => ! $block->is_active]);
        return back()->with('success', $block->is_active ? 'Bloc affiché.' : 'Bloc masqué.');
    }

    public function destroy(ContentBlock $block)
    {
        $block->delete();
        return redirect()->route('admin.blocks.index')->with('success', 'Bloc supprimé.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'zone' => ['required', Rule::in(array_keys(ContentBlock::ZONES))],
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);
    }
}
