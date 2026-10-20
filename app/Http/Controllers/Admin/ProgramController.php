<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::ordered()->paginate(30);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');
        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Programme créé.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');
        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Programme mis à jour.');
    }

    public function toggle(Program $program)
    {
        $program->update(['is_active' => ! $program->is_active]);
        return back()->with('success', $program->is_active ? 'Programme publié.' : 'Programme masqué.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Programme supprimé.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'category' => ['required', Rule::in(array_keys(Program::CATEGORIES))],
            'order' => 'nullable|integer',
        ]);
    }
}
