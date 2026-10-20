@extends('layouts.admin')

@section('title', 'Inbound Leads - Admin Khara Consulting')
@section('page-title', 'Inbound Leads')

@section('content')
<div class="flex flex-col gap-6">
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex flex-col">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Inbound Leads</h2>
            <p class="text-xs text-slate-500 font-medium mt-1">Gérez et suivez vos demandes de contact</p>
        </div>
        <a href="{{ route('admin.contacts.export', request()->query()) }}" class="bg-khara-red hover:bg-khara-red/90 text-white px-6 py-2.5 rounded-lg flex items-center gap-2 font-bold text-sm transition-all shadow-lg shadow-khara-red/20 shrink-0">
            <span class="material-symbols-outlined text-lg">download</span>
            Exporter CSV
        </a>
    </div>

    <!-- Filters Area -->
    <div class="mb-8">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex flex-wrap gap-4 items-center bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex-1 min-w-[280px] relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-lg focus:ring-2 focus:ring-khara-red/50 text-sm" placeholder="Rechercher par nom, email ou profil..." type="text"/>
            </div>
            <div class="flex flex-wrap gap-2">
                <select name="type" class="bg-slate-50 border-none rounded-lg text-sm font-medium py-2 px-4 focus:ring-2 focus:ring-khara-red/50 cursor-pointer">
                    <option value="">Tous les types</option>
                    <option value="entrepreneur" {{ request('type') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                    <option value="entreprise" {{ request('type') == 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                    <option value="professionnel" {{ request('type') == 'professionnel' ? 'selected' : '' }}>Professionnel</option>
                    <option value="etudiant" {{ request('type') == 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                    <option value="autre" {{ request('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
                <select name="status" class="bg-slate-50 border-none rounded-lg text-sm font-medium py-2 px-4 focus:ring-2 focus:ring-khara-red/50 cursor-pointer">
                    <option value="">Tous les statuts</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Nouveau</option>
                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Répondu</option>
                </select>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-slate-50 border-none rounded-lg text-sm font-medium py-2 px-4 focus:ring-2 focus:ring-khara-red/50">
                <button type="submit" class="bg-khara-red hover:bg-khara-red/90 text-white px-4 py-2 rounded-lg text-sm font-bold">Filtrer</button>
                <a href="{{ route('admin.contacts.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Réinitialiser</a>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="admin-card overflow-hidden !p-0">
        @if($contacts->count() > 0)
            <table class="w-full text-left font-[Montserrat]">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">person</span>
                                Client
                            </div>
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Profil</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Budget</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Statut</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($contacts as $contact)
                    @php $isReplied = $contact->email_sent; @endphp
                    <tr class="hover:bg-slate-50/50 transition-colors {{ $isReplied ? '' : '' }}">
                        <td class="px-6 py-5 {{ $isReplied ? 'text-slate-400' : 'text-slate-900' }}">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-full {{ $isReplied ? 'bg-slate-100' : 'bg-khara-red/10' }} flex items-center justify-center shrink-0">
                                    @if($isReplied)
                                        <span class="material-symbols-outlined text-slate-400 text-lg">account_circle</span>
                                    @else
                                        <span class="material-symbols-outlined text-khara-red text-lg">account_circle</span>
                                    @endif
                                </div>
                                <span class="{{ $isReplied ? 'font-medium' : 'font-semibold text-slate-900' }}">{{ $contact->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-sm {{ $isReplied ? 'text-slate-400 italic' : 'text-slate-600' }}">
                            <a href="mailto:{{ $contact->email }}" class="hover:text-khara-red hover:underline">{{ $contact->email }}</a>
                        </td>
                        <td class="px-6 py-5 text-sm">
                            <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-xs font-medium {{ $isReplied ? '!bg-slate-100 !text-slate-400' : '' }}">{{ ucfirst($contact->type) }}</span>
                        </td>
                        <td class="px-6 py-5 text-sm {{ $isReplied ? 'font-medium text-slate-400' : 'font-semibold text-slate-900' }}">{{ $contact->budget ?? '-' }}</td>
                        <td class="px-6 py-5 text-sm text-slate-600 {{ $isReplied ? '!text-slate-400' : '' }}">{{ $contact->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-5 text-center">
                            @if($isReplied)
                                <span class="border border-slate-300 text-slate-400 px-3 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest">Répondu</span>
                            @else
                                <span class="bg-khara-red text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm">Nouveau</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="text-khara-red hover:bg-khara-red/10 p-1.5 rounded-lg transition-colors" title="Voir le message">
                                    <span class="material-symbols-outlined text-xl">visibility</span>
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce contact ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-khara-red/60 hover:text-khara-red hover:bg-khara-red/10 p-1.5 rounded-lg transition-colors" title="Supprimer">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="bg-slate-50/50 px-6 py-4 flex items-center justify-between border-t border-slate-200 flex-wrap gap-4">
                <p class="text-xs text-slate-500 font-medium tracking-wide">
                    Affichage de {{ $contacts->firstItem() ?? 0 }} à {{ $contacts->lastItem() ?? 0 }} sur {{ $contacts->total() }} résultats
                </p>
                <div class="flex gap-2">
                    {{ $contacts->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <span class="material-symbols-outlined text-5xl text-slate-300 mb-4 block">inbox</span>
                <p class="text-slate-600 font-medium mb-2">Aucun contact trouvé</p>
                <p class="text-slate-500 text-sm">Modifiez vos critères de recherche</p>
            </div>
        @endif
    </div>
</div>
@endsection
