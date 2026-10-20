@extends('layouts.admin')

@section('title', 'Modifier une FAQ - Admin Khara Consulting')
@section('page-title', 'Modifier une FAQ')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="admin-card max-w-4xl">
        <h2 class="text-2xl font-display font-bold text-khara-slate mb-6">Modifier la FAQ</h2>

        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Question -->
                <div class="md:col-span-2">
                    <label for="question" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Question <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="question" 
                           name="question" 
                           value="{{ old('question', $faq->question) }}"
                           required
                           class="admin-input @error('question') border-khara-red @enderror">
                    @error('question')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Réponse -->
                <div class="md:col-span-2">
                    <label for="answer" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Réponse <span class="text-khara-red">*</span>
                    </label>
                    <textarea id="answer" 
                              name="answer" 
                              rows="6"
                              required
                              class="admin-input @error('answer') border-khara-red @enderror">{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catégorie -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Catégorie
                    </label>
                    <select id="category" 
                            name="category" 
                            class="admin-input @error('category') border-khara-red @enderror">
                        <option value="">Général</option>
                        <option value="Services" {{ old('category', $faq->category) == 'Services' ? 'selected' : '' }}>Services</option>
                        <option value="Tarifs" {{ old('category', $faq->category) == 'Tarifs' ? 'selected' : '' }}>Tarifs</option>
                        <option value="Formation" {{ old('category', $faq->category) == 'Formation' ? 'selected' : '' }}>Formation</option>
                        <option value="Contact" {{ old('category', $faq->category) == 'Contact' ? 'selected' : '' }}>Contact</option>
                        <option value="Autre" {{ old('category', $faq->category) == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('category')
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
                           value="{{ old('order', $faq->order) }}"
                           class="admin-input @error('order') border-khara-red @enderror">
                    @error('order')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut -->
                <div class="md:col-span-2 flex items-center">
                    <input type="checkbox" 
                           id="is_active" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', $faq->is_active) ? 'checked' : '' }}
                           class="w-5 h-5 text-khara-red border-khara-gray-300 rounded focus:ring-khara-red">
                    <label for="is_active" class="ml-3 text-sm font-semibold text-khara-slate font-sans">
                        Actif
                    </label>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.faqs.index') }}" class="admin-btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="admin-btn-primary">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
@endsection
