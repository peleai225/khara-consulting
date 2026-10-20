@extends('layouts.admin')

@section('title', 'Créer une FAQ - Admin Khara Consulting')
@section('page-title', 'Créer une FAQ')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-khara-red font-semibold text-sm transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Retour aux FAQ
    </a>

    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Nouvelle FAQ</h1>
        <p class="text-slate-500 mt-1">Ajoutez une question fréquente.</p>
    </div>

    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Question -->
                <div class="md:col-span-2">
                    <label for="question" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Question <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="question" 
                           name="question" 
                           value="{{ old('question') }}"
                           required
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('question') border-red-500 @enderror"
                           placeholder="Ex: Quels sont vos tarifs ?">
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
                              class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('answer') border-red-500 @enderror"
                              placeholder="La réponse à la question...">{{ old('answer') }}</textarea>
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
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('category') border-red-500 @enderror">
                        <option value="">Général</option>
                        <option value="Services" {{ old('category') == 'Services' ? 'selected' : '' }}>Services</option>
                        <option value="Tarifs" {{ old('category') == 'Tarifs' ? 'selected' : '' }}>Tarifs</option>
                        <option value="Formation" {{ old('category') == 'Formation' ? 'selected' : '' }}>Formation</option>
                        <option value="Contact" {{ old('category') == 'Contact' ? 'selected' : '' }}>Contact</option>
                        <option value="Autre" {{ old('category') == 'Autre' ? 'selected' : '' }}>Autre</option>
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
                           value="{{ old('order', 0) }}"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('order') border-red-500 @enderror">
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
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-5 h-5 text-khara-red border-khara-gray-300 rounded focus:ring-khara-red">
                    <label for="is_active" class="ml-3 text-sm font-semibold text-khara-slate font-sans">
                        Actif
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.faqs.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-khara-red text-white hover:bg-khara-red/90 shadow-lg shadow-khara-red/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">add</span>
                Créer la FAQ
            </button>
        </div>
    </form>
</div>
@endsection
