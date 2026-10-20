@extends('layouts.admin')
@section('title', 'Équipe - Admin')
@section('page-title', 'Équipe')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm text-khara-gray-500">Membres affichés sur la page « À propos ».</p>
        <a href="{{ route('admin.team.create') }}" class="admin-btn-primary inline-flex shrink-0"><span class="material-symbols-outlined text-lg mr-1">add</span>Ajouter</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if($members->count())
        <div class="overflow-x-auto"><table class="w-full admin-table text-left">
            <thead><tr><th>Photo</th><th>Nom</th><th>Fonction</th><th>Ordre</th><th>Statut</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            @foreach($members as $m)
                <tr>
                    <td>@if($m->photo)<img src="{{ asset('storage/'.$m->photo) }}" class="w-12 h-12 rounded-full object-cover" alt="">@else<div class="w-12 h-12 rounded-full bg-khara-gray-100 flex items-center justify-center text-slate-300"><span class="material-symbols-outlined">person</span></div>@endif</td>
                    <td class="font-semibold text-khara-slate">{{ $m->name }}</td>
                    <td class="text-slate-500">{{ $m->role ?: '—' }}</td>
                    <td class="text-slate-500">{{ $m->order }}</td>
                    <td><form action="{{ route('admin.team.toggle', $m) }}" method="POST">@csrf<button class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $m->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">{{ $m->is_active ? 'Affiché' : 'Masqué' }}</button></form></td>
                    <td><div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.team.edit', $m) }}" class="text-slate-500 hover:text-khara-red"><span class="material-symbols-outlined">edit</span></a>
                        <form action="{{ route('admin.team.destroy', $m) }}" method="POST" onsubmit="return confirm('Supprimer ?');">@csrf @method('DELETE')<button class="text-slate-500 hover:text-red-600"><span class="material-symbols-outlined">delete</span></button></form>
                    </div></td>
                </tr>
            @endforeach
            </tbody>
        </table></div>
        <div class="mt-4">{{ $members->links() }}</div>
        @else
        <div class="text-center py-12 text-slate-500"><span class="material-symbols-outlined text-4xl text-slate-300">groups</span><p class="mt-2">Aucun membre. La page À propos affichera un message neutre.</p><a href="{{ route('admin.team.create') }}" class="admin-btn-primary inline-flex mt-4">Ajouter le premier</a></div>
        @endif
    </div>
</div>
@endsection
