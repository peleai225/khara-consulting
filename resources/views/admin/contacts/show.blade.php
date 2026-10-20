@extends('layouts.admin')

@section('title', 'Détails du Contact - Admin Khara Consulting')
@section('page-title', 'Détails du Contact')

@section('content')
<div class="flex flex-col gap-6">
    <!-- Header avec retour -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-khara-red font-semibold text-sm transition-colors w-fit">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
            Retour aux contacts
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Colonne principale -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Carte contact -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="size-14 rounded-full {{ $contact->email_sent ? 'bg-slate-100' : 'bg-khara-red/10' }} flex items-center justify-center shrink-0">
                                @if($contact->email_sent)
                                    <span class="material-symbols-outlined text-slate-400 text-2xl">account_circle</span>
                                @else
                                    <span class="material-symbols-outlined text-khara-red text-2xl">account_circle</span>
                                @endif
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-slate-900">{{ $contact->name }}</h1>
                                <p class="text-sm text-slate-500 mt-0.5">{{ $contact->email }}</p>
                                @if($contact->email_sent)
                                    <span class="inline-block mt-2 border border-slate-300 text-slate-500 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest">Répondu</span>
                                @else
                                    <span class="inline-block mt-2 bg-khara-red text-white px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest">Nouveau</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="mailto:{{ $contact->email }}?subject=Re: Votre demande - Khara Consulting" class="inline-flex items-center gap-2 bg-khara-red hover:bg-khara-red/90 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                                <span class="material-symbols-outlined text-lg">mail</span>
                                Répondre
                            </a>
                            <a href="tel:{{ $contact->phone }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                                <span class="material-symbols-outlined text-lg">call</span>
                                Appeler
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Téléphone</p>
                            <a href="tel:{{ $contact->phone }}" class="text-slate-900 font-medium hover:text-khara-red transition-colors">{{ $contact->phone }}</a>
                        </div>
                        @if($contact->whatsapp)
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">WhatsApp</p>
                            <a href="https://wa.me/{{ str_replace([' ', '+'], '', $contact->whatsapp) }}" target="_blank" class="text-green-600 hover:text-green-700 font-medium">
                                {{ $contact->whatsapp }}
                            </a>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Profil</p>
                            <span class="inline-block px-2.5 py-1 bg-khara-red/10 text-khara-red rounded-full text-sm font-semibold">{{ $contact->type_label }}</span>
                        </div>
                        @if($contact->budget)
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Budget</p>
                            <p class="text-slate-900 font-medium">{{ $contact->budget_label }}</p>
                        </div>
                        @endif
                        <div class="sm:col-span-2">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Reçu le</p>
                            <p class="text-slate-600 text-sm">{{ $contact->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-khara-red">chat</span>
                    Message
                </h2>
                <div class="bg-slate-50 rounded-lg p-5 border border-slate-100">
                    <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Besoins -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-lg">category</span>
                    Besoins / Services
                </h3>
                @if(is_array($contact->needs) && count($contact->needs) > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($contact->needs_labels as $need)
                            <span class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium">{{ $need }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-slate-500 text-sm">Aucun besoin spécifié</p>
                @endif
            </div>

            <!-- Actions rapides -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-slate-900 mb-4">Actions</h3>
                <div class="space-y-3">
                    @if($contact->whatsapp)
                    <a href="https://wa.me/{{ str_replace([' ', '+'], '', $contact->whatsapp) }}?text=Bonjour {{ urlencode($contact->name) }}" target="_blank" class="flex items-center justify-center gap-2 w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-semibold text-sm transition-colors">
                        <span class="material-symbols-outlined">chat</span>
                        WhatsApp
                    </a>
                    @endif
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Supprimer ce contact ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-4 py-3 rounded-lg font-semibold text-sm transition-colors">
                            <span class="material-symbols-outlined">delete</span>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
