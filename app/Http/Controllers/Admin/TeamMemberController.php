<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::ordered()->paginate(20);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');
        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Membre ajouté.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('photo')) {
            if ($team->photo && Storage::disk('public')->exists($team->photo)) {
                Storage::disk('public')->delete($team->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');
        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Membre mis à jour.');
    }

    public function toggle(TeamMember $team)
    {
        $team->update(['is_active' => ! $team->is_active]);
        return back()->with('success', $team->is_active ? 'Membre affiché.' : 'Membre masqué.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo && Storage::disk('public')->exists($team->photo)) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Membre supprimé.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
        ]);
    }
}
