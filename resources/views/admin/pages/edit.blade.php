@extends('layouts.admin')

@section('title', 'Modifier une Page - Admin Khara Consulting')
@section('page-title', 'Modifier une Page')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="admin-card max-w-4xl">
        <h2 class="text-2xl font-display font-bold text-khara-slate mb-6">Modifier la page</h2>

        <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Slug (URL) <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="slug" 
                           name="slug" 
                           value="{{ old('slug', $page->slug) }}"
                           required
                           class="admin-input @error('slug') border-khara-red @enderror">
                    @error('slug')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Titre -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Titre <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $page->title) }}"
                           required
                           class="admin-input @error('title') border-khara-red @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hero Section -->
                <div class="border-t border-khara-gray-200 pt-6">
                    <h3 class="text-lg font-display font-bold text-khara-slate mb-4">Section Hero</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="hero_title" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Titre Hero
                            </label>
                            <input type="text" 
                                   id="hero_title" 
                                   name="hero_title" 
                                   value="{{ old('hero_title', $page->hero_title) }}"
                                   class="admin-input @error('hero_title') border-khara-red @enderror">
                            @error('hero_title')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="hero_subtitle" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Sous-titre Hero
                            </label>
                            <textarea id="hero_subtitle" 
                                      name="hero_subtitle" 
                                      rows="2"
                                      class="admin-input @error('hero_subtitle') border-khara-red @enderror">{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
                            @error('hero_subtitle')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="hero_image" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Image Hero
                            </label>
                            @if($page->hero_image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $page->hero_image) }}" 
                                         alt="Hero" 
                                         class="w-32 h-32 object-cover rounded-lg mb-2">
                                    <p class="text-xs text-khara-gray-500 font-sans">Image actuelle</p>
                                </div>
                            @endif
                            <input type="file" 
                                   id="hero_image" 
                                   name="hero_image" 
                                   accept="image/*"
                                   class="admin-input @error('hero_image') border-khara-red @enderror">
                            <p class="mt-1 text-xs text-khara-gray-500 font-sans">Laisser vide pour conserver l'image actuelle</p>
                            @error('hero_image')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contenu -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Contenu principal
                    </label>
                    <textarea id="content" 
                              name="content" 
                              rows="10"
                              class="admin-input @error('content') border-khara-red @enderror">{{ old('content', $page->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mission, Vision, Valeurs -->
                <div class="border-t border-khara-gray-200 pt-6">
                    <h3 class="text-lg font-display font-bold text-khara-slate mb-4">Informations supplémentaires</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="mission" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Mission
                            </label>
                            <textarea id="mission" 
                                      name="mission" 
                                      rows="4"
                                      class="admin-input @error('mission') border-khara-red @enderror">{{ old('mission', $page->mission) }}</textarea>
                            @error('mission')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="vision" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Vision
                            </label>
                            <textarea id="vision" 
                                      name="vision" 
                                      rows="4"
                                      class="admin-input @error('vision') border-khara-red @enderror">{{ old('vision', $page->vision) }}</textarea>
                            @error('vision')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="values" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                            Valeurs (séparées par des virgules)
                        </label>
                        <input type="text" 
                               id="values" 
                               name="values" 
                               value="{{ old('values', is_array($page->values) ? implode(', ', $page->values) : $page->values) }}"
                               class="admin-input @error('values') border-khara-red @enderror">
                        @error('values')
                            <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO -->
                <div class="border-t border-khara-gray-200 pt-6">
                    <h3 class="text-lg font-display font-bold text-khara-slate mb-4">SEO</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Meta Title
                            </label>
                            <input type="text" 
                                   id="meta_title" 
                                   name="meta_title" 
                                   value="{{ old('meta_title', $page->meta_title) }}"
                                   class="admin-input @error('meta_title') border-khara-red @enderror">
                            @error('meta_title')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Meta Description
                            </label>
                            <textarea id="meta_description" 
                                      name="meta_description" 
                                      rows="3"
                                      class="admin-input @error('meta_description') border-khara-red @enderror">{{ old('meta_description', $page->meta_description) }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Actif -->
                <div class="flex items-center">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" 
                               id="is_active" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $page->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-khara-red focus:ring-khara-red rounded">
                        <span class="text-khara-slate font-sans font-semibold">Page active</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.pages.index') }}" class="admin-btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="admin-btn-primary">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
@endsection

