@extends('layouts.admin')
@section('title', 'Chiffres clés - Admin')
@section('page-title', 'Chiffres clés')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm text-khara-gray-500">Affichés en bande sur l'accueil (ex : « 200+ » / « Entreprises accompagnées »).</p>
        <a href="{{ route('admin.stats.create') }}" class="admin-btn-primary inline-flex shrink-0"><span class="material-symbols-outlined text-lg mr-1">add</span>Ajouter</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if($stats->count())
        <div class="overflow-x-auto"><table class="w-full admin-table text-left">
            <thead><tr><th>Valeur</th><th>Libellé</th><th>Ordre</th><th>Statut</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            @foreach($stats as $s)
                <tr>
                    <td class="font-bold text-khara-red text-lg">{{ $s->value }}</td>
                    <td class="text-khara-slate">{{ $s->label }}</td>
                    <td class="text-slate-500">{{ $s->order }}</td>
                    <td><form action="{{ route('admin.stats.toggle', $s) }}" method="POST">@csrf<button class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $s->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">{{ $s->is_active ? 'Affiché' : 'Masqué' }}</button></form></td>
                    <td><div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.stats.edit', $s) }}" class="text-slate-500 hover:text-khara-red"><span class="material-symbols-outlined">edit</span></a>
                        <form action="{{ route('admin.stats.destroy', $s) }}" method="POST" onsubmit="return confirm('Supprimer ?');">@csrf @method('DELETE')<button class="text-slate-500 hover:text-red-600"><span class="material-symbols-outlined">delete</span></button></form>
                    </div></td>
                </tr>
            @endforeach
            </tbody>
        </table></div>
        <div class="mt-4">{{ $stats->links() }}</div>
        @else
        <div class="text-center py-12 text-slate-500"><span class="material-symbols-outlined text-4xl text-slate-300">trending_up</span><p class="mt-2">Aucun chiffre clé. La bande ne s'affiche pas tant qu'il n'y en a pas.</p><a href="{{ route('admin.stats.create') }}" class="admin-btn-primary inline-flex mt-4">Ajouter le premier</a></div>
        @endif
    </div>
</div>
@endsection
