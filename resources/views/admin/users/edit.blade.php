@extends('layouts.admin')

@section('title', 'Modifier un Utilisateur - Admin Khara Consulting')
@section('page-title', 'Modifier un Utilisateur')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="admin-card max-w-2xl">
        <h2 class="text-2xl font-display font-bold text-khara-slate mb-6">Modifier l'utilisateur</h2>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Nom et prénom <span class="text-khara-red">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           required
                           class="admin-input @error('name') border-khara-red @enderror">
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
                           value="{{ old('email', $user->email) }}"
                           required
                           class="admin-input @error('email') border-khara-red @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rôle -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">Rôle <span class="text-khara-red">*</span></label>
                    <select id="role" name="role" required class="admin-input @error('role') border-khara-red @enderror"
                            @if($user->id === auth()->id() && $user->isSuperAdmin()) title="Vous ne pouvez pas modifier votre propre rôle de super administrateur." @endif>
                        @foreach(\App\Models\User::ROLES as $value => $label)
                            <option value="{{ $value }}" {{ old('role', $user->role) === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Nouveau mot de passe
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           minlength="8"
                           class="admin-input @error('password') border-khara-red @enderror"
                           placeholder="Laisser vide pour ne pas changer">
                    <p class="mt-1 text-xs text-khara-gray-500 font-sans">Laisser vide pour conserver le mot de passe actuel</p>
                    @error('password')
                        <p class="mt-1 text-sm text-khara-red font-sans">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-khara-slate mb-2 font-sans">
                        Confirmer le nouveau mot de passe
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           minlength="8"
                           class="admin-input"
                           placeholder="Répétez le nouveau mot de passe">
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}" class="admin-btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="admin-btn-primary">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
@endsection

