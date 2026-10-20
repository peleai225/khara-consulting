@extends('layouts.admin')

@section('title', 'Créer un Utilisateur - Admin Khara Consulting')
@section('page-title', 'Créer un Utilisateur')

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-khara-red font-semibold text-sm transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Retour aux utilisateurs
    </a>

    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Nouvel utilisateur</h1>
        <p class="text-slate-500 mt-1">Créez un compte administrateur.</p>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <div class="space-y-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Nom et prénom <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           required
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('name') border-red-500 @enderror"
                           placeholder="John Doe">
                    @error('name')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Adresse email <span class="text-khara-red">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('email') border-red-500 @enderror"
                           placeholder="john.doe@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rôle -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Rôle <span class="text-khara-red">*</span>
                    </label>
                    <select id="role" name="role" required
                            class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('role') border-red-500 @enderror">
                        @foreach(\App\Models\User::ROLES as $value => $label)
                            <option value="{{ $value }}" {{ old('role', 'editor') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-slate-500">Super administrateur : accès total (y compris la gestion des comptes). Éditeur : gestion du contenu uniquement.</p>
                    @error('role')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Mot de passe <span class="text-khara-red">*</span>
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           minlength="8"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none @error('password') border-red-500 @enderror"
                           placeholder="Minimum 8 caractères">
                    @error('password')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Confirmer le mot de passe <span class="text-khara-red">*</span>
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required
                           minlength="8"
                           class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none"
                           placeholder="Répétez le mot de passe">
                </div>
            </div>

        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-khara-red text-white hover:bg-khara-red/90 shadow-lg shadow-khara-red/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">add</span>
                Créer l'utilisateur
            </button>
        </div>
    </form>
</div>
@endsection

