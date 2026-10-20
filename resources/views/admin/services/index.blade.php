@extends('layouts.admin')

@section('title', 'Gestion des Services - Admin Khara Consulting')
@section('page-title', 'Gestion des Services')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-khara-slate">Liste des services</h2>
            <p class="text-sm text-khara-gray-500 mt-1">Gérez les services proposés par Khara Consulting</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="admin-btn-primary inline-flex shrink-0">
            <span class="material-symbols-outlined text-lg mr-1">add</span>
            Nouveau service
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        @if($services->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full admin-table text-left">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-14 h-14 object-cover rounded-lg">
                                @else
                                    <div class="w-14 h-14 bg-khara-gray-100 rounded-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-khara-gray-400">image</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="font-medium">{{ $service->title }}</div>
                                <div class="text-xs text-khara-gray-500">{{ $service->slug }}</div>
                            </td>
                            <td>
                                <p class="text-sm text-khara-gray-600 line-clamp-2">{{ Str::limit($service->description, 80) }}</p>
                            </td>
                            <td class="text-sm text-khara-gray-500">{{ $service->order }}</td>
                            <td>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-khara-gray-100 text-khara-gray-600' }}">
                                    {{ $service->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.services.show', $service) }}" class="p-2 hover:bg-khara-gray-100 rounded-lg text-khara-gray-600 transition-colors" title="Voir">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service) }}" class="p-2 hover:bg-khara-red/10 rounded-lg text-khara-red transition-colors" title="Modifier">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce service ?');">
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
                {{ $services->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-5xl text-khara-gray-300 mb-4 block">work</span>
                <p class="text-khara-gray-600 font-medium mb-2">Aucun service</p>
                <a href="{{ route('admin.services.create') }}" class="admin-btn-primary inline-flex mt-4">Créer le premier service</a>
            </div>
        @endif
    </div>
</div>
@endsection
