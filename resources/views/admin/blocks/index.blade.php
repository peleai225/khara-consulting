@extends('layouts.admin')
@section('title', 'Contenus de sections - Admin')
@section('page-title', 'Contenus de sections')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm text-khara-gray-500">Piliers, étapes de méthode et arguments « Pourquoi Khara ». Si une zone est vide, le site affiche ses textes par défaut.</p>
        <a href="{{ route('admin.blocks.create') }}" class="admin-btn-primary inline-flex shrink-0"><span class="material-symbols-outlined text-lg mr-1">add</span>Ajouter</a>
    </div>

    @forelse($blocks as $zone => $items)
        <div class="admin-card">
            <h3 class="font-bold text-khara-slate mb-4">{{ \App\Models\ContentBlock::ZONES[$zone] ?? $zone }}</h3>
            <div class="space-y-2">
                @foreach($items as $b)
                    <div class="flex items-center justify-between gap-4 py-2 border-b border-khara-gray-100 last:border-0">
                        <div class="min-w-0">
                            <p class="font-semibold text-khara-slate truncate">{{ $b->title ?: '(sans titre)' }}</p>
                            @if($b->subtitle)<p class="text-sm text-slate-500 truncate">{{ $b->subtitle }}</p>@endif
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <form action="{{ route('admin.blocks.toggle', $b) }}" method="POST">@csrf<button class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $b->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">{{ $b->is_active ? 'Affiché' : 'Masqué' }}</button></form>
                            <a href="{{ route('admin.blocks.edit', $b) }}" class="text-slate-500 hover:text-khara-red"><span class="material-symbols-outlined">edit</span></a>
                            <form action="{{ route('admin.blocks.destroy', $b) }}" method="POST" onsubmit="return confirm('Supprimer ?');">@csrf @method('DELETE')<button class="text-slate-500 hover:text-red-600"><span class="material-symbols-outlined">delete</span></button></form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="admin-card text-center py-12 text-slate-500"><span class="material-symbols-outlined text-4xl text-slate-300">dashboard_customize</span><p class="mt-2">Aucun bloc personnalisé. Le site utilise ses contenus par défaut.</p><a href="{{ route('admin.blocks.create') }}" class="admin-btn-primary inline-flex mt-4">Créer un bloc</a></div>
    @endforelse
</div>
@endsection
