@extends('layouts.admin')

@section('title', 'Créer un Témoignage - Admin Khara Consulting')
@section('page-title', 'Créer un Témoignage')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-khara-red font-semibold text-sm transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Retour aux témoignages
    </a>

    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Nouveau témoignage</h1>
        <p class="text-slate-500 mt-1">Ajoutez un témoignage client.</p>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-khara-red">format_quote</span>
                Témoignage
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Nom <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           required
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('name') border-khara-red @enderror"
                           placeholder="Ex: Jean Dupont">
                    @error('name')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poste -->
                <div>
                    <label for="position" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Poste/Fonction
                    </label>
                    <input type="text" 
                           id="position" 
                           name="position" 
                           value="{{ old('position') }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('position') border-khara-red @enderror"
                           placeholder="Ex: Directeur Général">
                    @error('position')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Entreprise -->
                <div>
                    <label for="company" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Entreprise
                    </label>
                    <input type="text" 
                           id="company" 
                           name="company" 
                           value="{{ old('company') }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('company') border-khara-red @enderror"
                           placeholder="Ex: ABC Corporation">
                    @error('company')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Note -->
                <div>
                    <label for="rating" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Note (1-5)
                    </label>
                    <input type="number" 
                           id="rating" 
                           name="rating" 
                           value="{{ old('rating', 5) }}"
                           min="1"
                           max="5"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('rating') border-khara-red @enderror">
                    @error('rating')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div class="md:col-span-2">
                    <label for="photo" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Photo
                    </label>
                    <input type="file" 
                           id="photo" 
                           name="photo" 
                           accept="image/*"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('photo') border-khara-red @enderror">
                    <p class="mt-1 text-xs text-khara-gray-500 font-sans">Format: JPG, PNG (max 2MB)</p>
                    <div id="photo-preview" class="mt-4 hidden">
                        <img id="photo-preview-img" src="" alt="Preview" class="w-32 h-32 rounded-full object-cover">
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Témoignage -->
                <div class="md:col-span-2">
                    <label for="testimonial" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Témoignage <span class="text-khara-red">*</span>
                    </label>
                    <textarea id="testimonial" 
                              name="testimonial" 
                              rows="5"
                              required
                              class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('testimonial') border-khara-red @enderror"
                              placeholder="Le témoignage du client...">{{ old('testimonial') }}</textarea>
                    @error('testimonial')
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
                           value="{{ old('order', 0) }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('order') border-red-500 @enderror">
                    @error('order')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="is_active" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-5 h-5 text-khara-red border-khara-gray-300 rounded focus:ring-khara-red">
                    <label for="is_active" class="ml-3 text-sm font-semibold text-khara-slate font-sans">
                        Actif
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-khara-red text-white hover:bg-khara-red/90 shadow-lg shadow-khara-red/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">add</span>
                Créer le témoignage
            </button>
        </div>
    </form>
</div>
@endsection
