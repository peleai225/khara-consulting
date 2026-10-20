@extends('layouts.admin')

@section('title', $realisation->title . ' - Admin')
@section('page-title', $realisation->title)

@section('content')
<div class="admin-card max-w-3xl space-y-5">
    @if($realisation->image)
        <img src="{{ asset('storage/' . $realisation->image) }}" alt="{{ $realisation->title }}" class="w-full max-h-72 object-cover rounded-xl">
    @endif
    <div class="flex flex-wrap gap-2 text-sm">
        @if($realisation->sector)<span class="px-3 py-1 rounded-full bg-khara-red/10 text-khara-red font-semibold">{{ $realisation->sector }}</span>@endif
        @if($realisation->client)<span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600">{{ $realisation->client }}</span>@endif
        <span class="px-3 py-1 rounded-full {{ $realisation->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">{{ $realisation->is_active ? 'Publiée' : 'Masquée' }}</span>
    </div>
    @if($realisation->summary)<p class="text-slate-700">{{ $realisation->summary }}</p>@endif
    @foreach(['challenge' => 'Le défi', 'solution' => 'La solution', 'result' => 'Les résultats'] as $field => $label)
        @if($realisation->$field)
            <div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">{{ $label }}</h3>
                <p class="text-slate-600 whitespace-pre-wrap">{{ $realisation->$field }}</p>
            </div>
        @endif
    @endforeach
    <div class="flex gap-3 pt-4 border-t border-slate-100">
        <a href="{{ route('admin.realisations.edit', $realisation) }}" class="admin-btn-primary">Modifier</a>
        <a href="{{ route('admin.realisations.index') }}" class="admin-btn-secondary">Retour</a>
    </div>
</div>
@endsection
