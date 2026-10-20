@extends('layouts.admin')

@section('title', 'Détails Slide - Admin Khara Consulting')
@section('page-title', 'Détails Slide')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.slides.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="admin-card">
                <h2 class="text-2xl font-display font-bold text-khara-slate mb-6">Informations</h2>
                
                <div class="space-y-6">
                    @if($slide->badge_text)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Badge</label>
                        <p class="text-khara-slate font-sans">{{ $slide->badge_text }}</p>
                    </div>
                    @endif
                    
                    @if($slide->title)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Titre</label>
                        <p class="text-lg font-display font-bold text-khara-slate">{{ $slide->title }}</p>
                    </div>
                    @endif
                    
                    @if($slide->subtitle)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Sous-titre</label>
                        <p class="text-khara-slate font-sans">{{ $slide->subtitle }}</p>
                    </div>
                    @endif
                    
                    @if($slide->description)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Description</label>
                        <p class="text-khara-slate font-sans">{{ $slide->description }}</p>
                    </div>
                    @endif
                    
                    @if($slide->image)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Image</label>
                        <img src="{{ asset('storage/' . $slide->image) }}" 
                             alt="Slide" 
                             class="w-full max-w-md rounded-lg">
                    </div>
                    @endif
                    
                    @if($slide->button_text || $slide->button_text_2)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-2 font-sans">Boutons</label>
                        <div class="space-y-2">
                            @if($slide->button_text)
                                <div>
                                    <span class="font-sans font-semibold text-khara-slate">{{ $slide->button_text }}</span>
                                    <span class="text-sm text-khara-gray-500 font-sans ml-2">→ {{ $slide->button_link }}</span>
                                </div>
                            @endif
                            @if($slide->button_text_2)
                                <div>
                                    <span class="font-sans font-semibold text-khara-slate">{{ $slide->button_text_2 }}</span>
                                    <span class="text-sm text-khara-gray-500 font-sans ml-2">→ {{ $slide->button_link_2 }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <div class="admin-card">
                <h3 class="text-xl font-display font-bold text-khara-slate mb-4">Détails</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Ordre</label>
                        <p class="text-khara-slate font-sans">{{ $slide->order }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Position image</label>
                        <p class="text-khara-slate font-sans">{{ $slide->background_position }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Statut</label>
                        @if($slide->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-sans font-semibold">Actif</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-sans font-semibold">Inactif</span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Créé le</label>
                        <p class="text-khara-slate font-sans">{{ $slide->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="admin-card mt-6">
                <h3 class="text-xl font-display font-bold text-khara-slate mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.slides.edit', $slide) }}" class="block w-full admin-btn-primary text-center">
                        Modifier
                    </a>
                    <form action="{{ route('admin.slides.destroy', $slide) }}" 
                          method="POST" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce slide ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full admin-btn-danger py-3">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

