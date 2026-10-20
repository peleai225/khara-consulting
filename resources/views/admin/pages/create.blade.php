@extends('layouts.admin')

@section('title', 'Créer une Page - Admin Khara Consulting')
@section('page-title', 'Créer une Page')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-khara-red font-semibold text-sm transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Retour aux pages
    </a>

    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Nouvelle page</h1>
        <p class="text-slate-500 mt-1">Créez une nouvelle page pour le site.</p>
    </div>

    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <div class="space-y-6">
                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Slug (URL) <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="slug" 
                           name="slug" 
                           value="{{ old('slug') }}"
                           required
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('slug') border-red-500 @enderror"
                           placeholder="Ex: about, home, services">
                    <p class="mt-1 text-xs text-khara-gray-500 font-sans">Identifiant unique de la page (utilisé dans l'URL)</p>
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
                           value="{{ old('title') }}"
                           required
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('title') border-red-500 @enderror"
                           placeholder="Titre de la page">
                    @error('title')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hero Section -->
                <div class="border-t border-slate-200 pt-6 mt-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">image</span>
                        Section Hero
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="hero_title" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Titre Hero
                            </label>
                            <input type="text" 
                                   id="hero_title" 
                                   name="hero_title" 
                                   value="{{ old('hero_title') }}"
                                   class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('hero_title') border-red-500 @enderror"
                                   placeholder="Titre principal de la section hero">
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
                                      class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('hero_subtitle') border-red-500 @enderror"
                                      placeholder="Sous-titre de la section hero">{{ old('hero_subtitle') }}</textarea>
                            @error('hero_subtitle')
                                <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="hero_image" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Image Hero
                            </label>
                            <input type="file" 
                                   id="hero_image" 
                                   name="hero_image" 
                                   accept="image/*"
                                   class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('hero_image') border-red-500 @enderror">
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
                              class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('content') border-red-500 @enderror"
                              placeholder="Contenu HTML de la page">{{ old('content') }}</textarea>
                    <p class="mt-1 text-xs text-khara-gray-500 font-sans">HTML autorisé</p>
                    @error('content')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mission, Vision, Valeurs (pour page About) -->
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
                                      class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('mission') border-red-500 @enderror"
                                      placeholder="Mission de l'entreprise">{{ old('mission') }}</textarea>
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
                                      class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('vision') border-red-500 @enderror"
                                      placeholder="Vision de l'entreprise">{{ old('vision') }}</textarea>
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
                               value="{{ old('values') }}"
                               class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('values') border-red-500 @enderror"
                               placeholder="Ex: Excellence, Innovation, Impact">
                        <p class="mt-1 text-xs text-khara-gray-500 font-sans">Séparez les valeurs par des virgules</p>
                        @error('values')
                            <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO -->
                <div class="border-t border-slate-200 pt-6 mt-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">search</span>
                        SEO
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                                Meta Title
                            </label>
                            <input type="text" 
                                   id="meta_title" 
                                   name="meta_title" 
                                   value="{{ old('meta_title') }}"
                                   class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('meta_title') border-red-500 @enderror"
                                   placeholder="Titre SEO">
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
                                      class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('meta_description') border-red-500 @enderror"
                                      placeholder="Description SEO">{{ old('meta_description') }}</textarea>
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
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 text-khara-red focus:ring-khara-red rounded">
                        <span class="text-khara-slate font-sans font-semibold">Page active</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.pages.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-khara-red text-white hover:bg-khara-red/90 shadow-lg shadow-khara-red/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">add</span>
                Créer la page
            </button>
        </div>
    </form>
</div>
@endsection

