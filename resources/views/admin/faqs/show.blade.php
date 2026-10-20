@extends('layouts.admin')

@section('title', 'Détails de la FAQ - Admin Khara Consulting')
@section('page-title', 'Détails de la FAQ')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="admin-card max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-display font-bold text-khara-slate">Détails de la FAQ</h2>
            <a href="{{ route('admin.faqs.edit', $faq) }}" class="admin-btn-primary">
                Modifier
            </a>
        </div>

        <div class="space-y-6">
            <div>
                <h3 class="text-xl font-display font-bold text-khara-slate mb-2">Question</h3>
                <p class="text-lg text-khara-gray-700 font-sans">{{ $faq->question }}</p>
            </div>
            
            <div>
                <h3 class="text-xl font-display font-bold text-khara-slate mb-2">Réponse</h3>
                <div class="text-khara-gray-700 font-sans font-light leading-relaxed">
                    {!! nl2br(e($faq->answer)) !!}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t border-khara-gray-200">
                <div>
                    <span class="text-sm text-khara-gray-600 font-sans">Catégorie:</span>
                    <p class="text-sm font-sans font-semibold mt-1">
                        <span class="px-2 py-1 bg-khara-red/10 text-khara-red rounded-full">
                            {{ $faq->category ?? 'Général' }}
                        </span>
                    </p>
                </div>
                <div>
                    <span class="text-sm text-khara-gray-600 font-sans">Ordre:</span>
                    <p class="text-sm font-sans font-semibold mt-1">{{ $faq->order }}</p>
                </div>
                <div>
                    <span class="text-sm text-khara-gray-600 font-sans">Statut:</span>
                    <p class="mt-1">
                        @if($faq->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-sans font-semibold">Actif</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-sans font-semibold">Inactif</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

