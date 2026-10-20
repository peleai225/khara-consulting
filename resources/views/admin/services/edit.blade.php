@extends('layouts.admin')

@section('title', 'Modifier un Service - Admin Khara Consulting')
@section('page-title', 'Modifier un Service')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-khara-red font-semibold text-sm transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Retour aux services
    </a>

    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Modifier le service</h1>
        <p class="text-slate-500 mt-1">{{ $service->title }}</p>
    </div>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-8">
            <!-- Informations principales -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-khara-red">info</span>
                    Informations principales
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Titre <span class="text-khara-red">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('title') border-red-500 @enderror"
                            placeholder="Ex: Formation en Leadership">
                        @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="slug" class="block text-sm font-semibold text-slate-700 mb-2">Slug (URL)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug) }}"
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('slug') border-red-500 @enderror"
                            placeholder="Auto-généré si vide">
                        <p class="mt-1 text-xs text-slate-500">Laisser vide pour générer automatiquement</p>
                        @error('slug')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description courte</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('description') border-red-500 @enderror"
                            placeholder="Description courte du service">{{ old('description', $service->description) }}</textarea>
                        @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Contenu détaillé</label>
                        <textarea id="content" name="content" rows="6"
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('content') border-red-500 @enderror"
                            placeholder="Contenu détaillé du service (HTML autorisé)">{{ old('content', $service->content) }}</textarea>
                        @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Média et affichage -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-khara-red">image</span>
                    Média et affichage
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="icon" class="block text-sm font-semibold text-slate-700 mb-2">Icône</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $service->icon) }}"
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('icon') border-red-500 @enderror"
                            placeholder="Ex: school, group_add">
                        <p class="mt-1 text-xs text-slate-500">Material Symbols (school, group_add, lightbulb...)</p>
                        @error('icon')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Image</label>
                        @if($service->image)
                        <div class="flex items-center gap-4 mb-3">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="size-20 object-cover rounded-lg border border-slate-200">
                            <p class="text-xs text-slate-500">Image actuelle</p>
                        </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-khara-red/10 file:text-khara-red hover:file:bg-khara-red/20 @error('image') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-slate-500">Laisser vide pour conserver l'image actuelle</p>
                        @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="order" class="block text-sm font-semibold text-slate-700 mb-2">Ordre d'affichage</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $service->order) }}" min="0"
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('order') border-red-500 @enderror">
                        @error('order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-slate-300 text-khara-red focus:ring-khara-red/20">
                            <span class="text-sm font-semibold text-slate-700">Service actif</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.services.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
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
