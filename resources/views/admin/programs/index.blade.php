@extends('layouts.admin')
@section('title', 'Programmes - Admin')
@section('page-title', 'Programmes')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm text-khara-gray-500">Domaines de formation et formats affichés sur la page « Programmes ».</p>
        <a href="{{ route('admin.programs.create') }}" class="admin-btn-primary inline-flex shrink-0"><span class="material-symbols-outlined text-lg mr-1">add</span>Ajouter</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if($programs->count())
        <div class="overflow-x-auto"><table class="w-full admin-table text-left">
            <thead><tr><th>Titre</th><th>Catégorie</th><th>Ordre</th><th>Statut</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            @foreach($programs as $p)
                <tr>
                    <td class="font-semibold text-khara-slate">{{ $p->title }}</td>
                    <td class="text-slate-500">{{ \App\Models\Program::CATEGORIES[$p->category] ?? $p->category }}</td>
                    <td class="text-slate-500">{{ $p->order }}</td>
                    <td><form action="{{ route('admin.programs.toggle', $p) }}" method="POST">@csrf<button class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">{{ $p->is_active ? 'Publié' : 'Masqué' }}</button></form></td>
                    <td><div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.programs.edit', $p) }}" class="text-slate-500 hover:text-khara-red"><span class="material-symbols-outlined">edit</span></a>
                        <form action="{{ route('admin.programs.destroy', $p) }}" method="POST" onsubmit="return confirm('Supprimer ?');">@csrf @method('DELETE')<button class="text-slate-500 hover:text-red-600"><span class="material-symbols-outlined">delete</span></button></form>
                    </div></td>
                </tr>
            @endforeach
            </tbody>
        </table></div>
        <div class="mt-4">{{ $programs->links() }}</div>
        @else
        <div class="text-center py-12 text-slate-500"><span class="material-symbols-outlined text-4xl text-slate-300">school</span><p class="mt-2">Aucun programme.</p><a href="{{ route('admin.programs.create') }}" class="admin-btn-primary inline-flex mt-4">Ajouter le premier</a></div>
        @endif
    </div>
</div>
@endsection
