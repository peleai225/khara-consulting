@extends('layouts.admin')

@section('title', 'Gestion des Témoignages - Admin Khara Consulting')
@section('page-title', 'Gestion des Témoignages')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-khara-slate">Liste des témoignages</h2>
            <p class="text-sm text-khara-gray-500 mt-1">Gérez les témoignages clients</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="admin-btn-primary inline-flex shrink-0">
            <span class="material-symbols-outlined text-lg mr-1">add</span>
            Nouveau témoignage
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        @if($testimonials->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full admin-table text-left">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Entreprise</th>
                            <th>Note</th>
                            <th>Témoignage</th>
                            <th>Statut</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>
                                @if($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 bg-khara-red rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="font-medium">{{ $testimonial->name }}</div>
                                @if($testimonial->position)
                                    <div class="text-xs text-khara-gray-500">{{ $testimonial->position }}</div>
                                @endif
                            </td>
                            <td class="text-sm text-khara-gray-600">{{ $testimonial->company ?? '-' }}</td>
                            <td>
                                <div class="flex gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-lg {{ $i <= ($testimonial->rating ?? 5) ? 'text-amber-500' : 'text-khara-gray-600' }}">star</span>
                                    @endfor
                                </div>
                            </td>
                            <td><p class="text-sm text-khara-gray-600 line-clamp-2 max-w-xs">{{ Str::limit($testimonial->testimonial, 100) }}</p></td>
                            <td>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $testimonial->is_active ? 'bg-green-100 text-green-800' : 'bg-khara-gray-100 text-khara-gray-600' }}">
                                    {{ $testimonial->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="p-2 hover:bg-khara-red/10 rounded-lg text-khara-red transition-colors" title="Modifier">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce témoignage ?');">
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
                {{ $testimonials->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-5xl text-khara-gray-300 mb-4 block">format_quote</span>
                <p class="text-khara-gray-600 font-medium mb-2">Aucun témoignage</p>
                <a href="{{ route('admin.testimonials.create') }}" class="admin-btn-primary inline-flex mt-4">Créer le premier témoignage</a>
            </div>
        @endif
    </div>
</div>
@endsection
