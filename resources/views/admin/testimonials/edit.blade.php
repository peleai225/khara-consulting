@extends('layouts.admin')

@section('title', 'Modifier un Témoignage - Admin Khara Consulting')
@section('page-title', 'Modifier un Témoignage')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="admin-card max-w-4xl">
        <h2 class="text-2xl font-display font-bold text-khara-slate mb-6">Modifier le témoignage</h2>

        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Nom <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $testimonial->name) }}"
                           required
                           class="admin-input @error('name') border-khara-red @enderror">
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
                           value="{{ old('position', $testimonial->position) }}"
                           class="admin-input @error('position') border-khara-red @enderror">
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
                           value="{{ old('company', $testimonial->company) }}"
                           class="admin-input @error('company') border-khara-red @enderror">
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
                           value="{{ old('rating', $testimonial->rating) }}"
                           min="1"
                           max="5"
                           class="admin-input @error('rating') border-khara-red @enderror">
                    @error('rating')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div class="md:col-span-2">
                    <label for="photo" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Photo
                    </label>
                    @if($testimonial->photo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" 
                             alt="{{ $testimonial->name }}" 
                             class="w-32 h-32 rounded-full object-cover">
                    </div>
                    @endif
                    <input type="file" 
                           id="photo" 
                           name="photo" 
                           accept="image/*"
                           class="admin-input @error('photo') border-khara-red @enderror">
                    <p class="mt-1 text-xs text-khara-gray-500 font-sans">Laisser vide pour conserver l'image actuelle</p>
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
                              class="admin-input @error('testimonial') border-khara-red @enderror">{{ old('testimonial', $testimonial->testimonial) }}</textarea>
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
                           value="{{ old('order', $testimonial->order) }}"
                           class="admin-input @error('order') border-khara-red @enderror">
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
                           {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}
                           class="w-5 h-5 text-khara-red border-khara-gray-300 rounded focus:ring-khara-red">
                    <label for="is_active" class="ml-3 text-sm font-semibold text-khara-slate font-sans">
                        Actif
                    </label>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.testimonials.index') }}" class="admin-btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="admin-btn-primary">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
@endsection
