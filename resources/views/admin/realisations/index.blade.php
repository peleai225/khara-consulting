@extends('layouts.admin')

@section('title', 'Réalisations - Admin Khara Consulting')
@section('page-title', 'Réalisations')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-khara-slate">Études de cas &amp; réalisations</h2>
            <p class="text-sm text-khara-gray-500 mt-1">Les 3 plus récentes s'affichent sur l'accueil.</p>
        </div>
        <a href="{{ route('admin.realisations.create') }}" class="admin-btn-primary inline-flex shrink-0">
            <span class="material-symbols-outlined text-lg mr-1">add</span>
            Nouvelle réalisation
        </a>
    </div>

    <form method="GET" class="flex gap-2 max-w-md">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher (titre, secteur)…" class="admin-input">
        <button class="admin-btn-secondary">Rechercher</button>
    </form>

    <div class="admin-card overflow-hidden">
        @if($realisations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full admin-table text-left">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Secteur</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($realisations as $r)
                        <tr>
                            <td>
                                @if($r->image)
                                    <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}" class="w-14 h-14 object-cover rounded-lg">
                                @else
                                    <div class="w-14 h-14 bg-khara-gray-100 rounded-lg flex items-center justify-center text-slate-300">
                                        <span class="material-symbols-outlined">image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="font-semibold text-khara-slate">{{ $r->title }}</td>
                            <td class="text-slate-500">{{ $r->sector ?: '—' }}</td>
                            <td class="text-slate-500">{{ $r->order }}</td>
                            <td>
                                <form action="{{ route('admin.realisations.toggle', $r) }}" method="POST">
                                    @csrf
                                    <button class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $r->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $r->is_active ? 'Publiée' : 'Masquée' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.realisations.edit', $r) }}" class="text-slate-500 hover:text-khara-red" title="Modifier"><span class="material-symbols-outlined">edit</span></a>
                                    <form action="{{ route('admin.realisations.destroy', $r) }}" method="POST" onsubmit="return confirm('Supprimer cette réalisation ?');">
                                        @csrf @method('DELETE')
                                        <button class="text-slate-500 hover:text-red-600" title="Supprimer"><span class="material-symbols-outlined">delete</span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $realisations->links() }}</div>
        @else
            <div class="text-center py-12 text-slate-500">
                <span class="material-symbols-outlined text-4xl text-slate-300">workspace_premium</span>
                <p class="mt-2">Aucune réalisation pour l'instant.</p>
                <a href="{{ route('admin.realisations.create') }}" class="admin-btn-primary inline-flex mt-4">Créer la première</a>
            </div>
        @endif
    </div>
</div>
@endsection
