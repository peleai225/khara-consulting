@extends('layouts.admin')

@section('title', 'Modifier un Slide - Admin Khara Consulting')
@section('page-title', 'Modifier un Slide')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.slides.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-khara-red font-semibold text-sm transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Retour aux slides
    </a>

    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Modifier le slide</h1>
        <p class="text-slate-500 mt-1">{{ $slide->title ?: 'Slide #' . $slide->id }}</p>
    </div>

    <form action="{{ route('admin.slides.update', $slide) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-8">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-khara-red">view_carousel</span>
                    Contenu du slide
                </h2>
                <div class="space-y-6">
                <!-- Badge -->
                <div>
                    <label for="badge_text" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Texte du badge
                    </label>
                    <input type="text" 
                           id="badge_text" 
                           name="badge_text" 
                           value="{{ old('badge_text', $slide->badge_text) }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('badge_text') border-red-500 @enderror">
                    @error('badge_text')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Titre -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Titre principal
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $slide->title) }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sous-titre -->
                <div>
                    <label for="subtitle" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Sous-titre
                    </label>
                    <input type="text" 
                           id="subtitle" 
                           name="subtitle" 
                           value="{{ old('subtitle', $slide->subtitle) }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('subtitle') border-red-500 @enderror">
                    @error('subtitle')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('description') border-red-500 @enderror">{{ old('description', $slide->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="button_text" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                            Texte du bouton 1
                        </label>
                        <input type="text" 
                               id="button_text" 
                               name="button_text" 
                               value="{{ old('button_text', $slide->button_text) }}"
                               class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('button_text') border-red-500 @enderror">
                        @error('button_text')
                            <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="button_link" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                            Lien du bouton 1
                        </label>
                        <input type="text" 
                               id="button_link" 
                               name="button_link" 
                               value="{{ old('button_link', $slide->button_link) }}"
                               class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('button_link') border-red-500 @enderror">
                        @error('button_link')
                            <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="button_text_2" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                            Texte du bouton 2
                        </label>
                        <input type="text" 
                               id="button_text_2" 
                               name="button_text_2" 
                               value="{{ old('button_text_2', $slide->button_text_2) }}"
                               class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('button_text_2') border-red-500 @enderror">
                        @error('button_text_2')
                            <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="button_link_2" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                            Lien du bouton 2
                        </label>
                        <input type="text" 
                               id="button_link_2" 
                               name="button_link_2" 
                               value="{{ old('button_link_2', $slide->button_link_2) }}"
                               class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('button_link_2') border-red-500 @enderror">
                        @error('button_link_2')
                            <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Image de fond
                    </label>
                    @if($slide->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $slide->image) }}" 
                                 alt="Slide" 
                                 class="w-32 h-32 object-cover rounded-lg mb-2">
                            <p class="text-xs text-khara-gray-500 font-sans">Image actuelle</p>
                        </div>
                    @endif
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/*"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('image') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-khara-gray-500 font-sans">Laisser vide pour conserver l'image actuelle</p>
                    @error('image')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position de l'image -->
                <div>
                    <label for="background_position" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Position de l'image
                    </label>
                    <select id="background_position" 
                            name="background_position" 
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('background_position') border-red-500 @enderror">
                        <option value="center" {{ old('background_position', $slide->background_position) == 'center' ? 'selected' : '' }}>Centre</option>
                        <option value="center right" {{ old('background_position', $slide->background_position) == 'center right' ? 'selected' : '' }}>Centre Droite</option>
                        <option value="center left" {{ old('background_position', $slide->background_position) == 'center left' ? 'selected' : '' }}>Centre Gauche</option>
                        <option value="top" {{ old('background_position', $slide->background_position) == 'top' ? 'selected' : '' }}>Haut</option>
                        <option value="bottom" {{ old('background_position', $slide->background_position) == 'bottom' ? 'selected' : '' }}>Bas</option>
                    </select>
                    @error('background_position')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ordre -->
                <div>
                    <label for="order" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Ordre d'affichage
                    </label>
                    <input type="number" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', $slide->order) }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('order') border-red-500 @enderror"
                           min="0">
                    @error('order')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actif -->
                <div class="flex items-center">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" 
                               id="is_active" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $slide->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 rounded border-slate-300 text-khara-red focus:ring-khara-red/20">
                        <span class="text-khara-slate font-sans font-semibold">Slide actif</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.slides.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-khara-red text-white hover:bg-khara-red/90 shadow-lg shadow-khara-red/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">save</span>
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection

