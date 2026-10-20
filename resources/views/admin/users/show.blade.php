@extends('layouts.admin')

@section('title', 'Détails Utilisateur - Admin Khara Consulting')
@section('page-title', 'Détails Utilisateur')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="admin-card">
                <h2 class="text-2xl font-display font-bold text-khara-slate mb-6">Informations</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Nom et prénom</label>
                        <p class="text-lg font-display font-bold text-khara-slate">{{ $user->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Email</label>
                        <p class="text-lg text-khara-slate font-sans">{{ $user->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Compte créé le</label>
                        <p class="text-khara-slate font-sans">{{ $user->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Email vérifié</label>
                        <p class="text-khara-slate font-sans">
                            @if($user->email_verified_at)
                                <span class="text-green-600 font-semibold">Oui</span> - {{ $user->email_verified_at->format('d/m/Y à H:i') }}
                            @else
                                <span class="text-red-600 font-semibold">Non</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="admin-card">
                <h3 class="text-xl font-display font-bold text-khara-slate mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user) }}" class="block w-full admin-btn-primary text-center">
                        Modifier
                    </a>
                    @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" 
                              method="POST" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full admin-btn-danger py-3">
                                Supprimer
                            </button>
                        </form>
                    @else
                        <p class="text-sm text-khara-gray-500 font-sans text-center">Vous ne pouvez pas supprimer votre propre compte</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

