@extends('layouts.admin')

@section('title', 'Gestion des Utilisateurs - Admin Khara Consulting')
@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-khara-slate">Liste des administrateurs</h2>
            <p class="text-sm text-khara-gray-500 mt-1">Gérez les utilisateurs ayant accès au backoffice</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="admin-btn-primary inline-flex shrink-0">
            <span class="material-symbols-outlined text-lg mr-1">add</span>
            Nouvel utilisateur
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full admin-table text-left">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Créé le</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="size-10 rounded-full bg-khara-red flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium">{{ $user->name }}</div>
                                        @if($user->id === auth()->id())
                                            <span class="text-xs text-khara-red font-medium">Vous</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-khara-gray-600">{{ $user->email }}</td>
                            <td class="text-sm text-khara-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="p-2 hover:bg-khara-gray-100 rounded-lg text-khara-gray-600 transition-colors" title="Voir">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-2 hover:bg-khara-red/10 rounded-lg text-khara-red transition-colors" title="Modifier">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 hover:bg-red-50 rounded-lg text-red-600 transition-colors" title="Supprimer">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 pt-4 px-6 border-t border-khara-gray-200">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-5xl text-khara-gray-300 mb-4 block">person</span>
                <p class="text-khara-gray-600 font-medium mb-2">Aucun utilisateur</p>
                <a href="{{ route('admin.users.create') }}" class="admin-btn-primary inline-flex mt-4">Créer le premier utilisateur</a>
            </div>
        @endif
    </div>
</div>
@endsection
