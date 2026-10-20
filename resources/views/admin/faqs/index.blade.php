@extends('layouts.admin')

@section('title', 'Gestion des FAQ - Admin Khara Consulting')
@section('page-title', 'Gestion des FAQ')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-khara-slate">Liste des FAQ</h2>
            <p class="text-sm text-khara-gray-500 mt-1">Gérez les questions fréquentes</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="admin-btn-primary inline-flex shrink-0">
            <span class="material-symbols-outlined text-lg mr-1">add</span>
            Nouvelle FAQ
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        @if($faqs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full admin-table text-left">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Catégorie</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td>
                                <div class="font-medium">{{ $faq->question }}</div>
                                <div class="text-sm text-khara-gray-500 mt-1 line-clamp-2 max-w-md">{{ Str::limit($faq->answer, 100) }}</div>
                            </td>
                            <td>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-khara-red/10 text-khara-red">
                                    {{ $faq->category ?? 'Général' }}
                                </span>
                            </td>
                            <td class="text-sm text-khara-gray-500">{{ $faq->order }}</td>
                            <td>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $faq->is_active ? 'bg-green-100 text-green-800' : 'bg-khara-gray-100 text-khara-gray-600' }}">
                                    {{ $faq->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="p-2 hover:bg-khara-red/10 rounded-lg text-khara-red transition-colors" title="Modifier">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette FAQ ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 hover:bg-red-50 rounded-lg text-red-600 transition-colors" title="Supprimer">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 pt-4 px-6 border-t border-khara-gray-200">
                {{ $faqs->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-5xl text-khara-gray-300 mb-4 block">quiz</span>
                <p class="text-khara-gray-600 font-medium mb-2">Aucune FAQ</p>
                <a href="{{ route('admin.faqs.create') }}" class="admin-btn-primary inline-flex mt-4">Créer la première FAQ</a>
            </div>
        @endif
    </div>
</div>
@endsection
