@extends('layouts.admin')

@section('title', 'Détails du Témoignage - Admin Khara Consulting')
@section('page-title', 'Détails du Témoignage')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="admin-card max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-display font-bold text-khara-slate">Détails du témoignage</h2>
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="admin-btn-primary">
                Modifier
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                @if($testimonial->photo)
                <img src="{{ asset('storage/' . $testimonial->photo) }}" 
                     alt="{{ $testimonial->name }}" 
                     class="w-32 h-32 rounded-full object-cover mb-6">
                @else
                <div class="w-32 h-32 bg-khara-red rounded-full flex items-center justify-center mb-6">
                    <span class="text-white font-display font-bold text-4xl">{{ substr($testimonial->name, 0, 1) }}</span>
                </div>
                @endif
                
                <h3 class="text-2xl font-display font-bold text-khara-slate mb-2">{{ $testimonial->name }}</h3>
                @if($testimonial->position)
                <p class="text-khara-gray-600 font-sans mb-1">{{ $testimonial->position }}</p>
                @endif
                @if($testimonial->company)
                <p class="text-khara-red font-sans font-semibold">{{ $testimonial->company }}</p>
                @endif
                
                <div class="flex items-center mt-4">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-6 h-6 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
            </div>
            
            <div>
                <h4 class="text-lg font-display font-bold text-khara-slate mb-4">Témoignage</h4>
                <p class="text-khara-gray-700 font-sans font-light leading-relaxed italic mb-6">
                    "{{ $testimonial->testimonial }}"
                </p>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-khara-gray-600 font-sans">Ordre:</span>
                        <span class="text-sm font-sans font-semibold">{{ $testimonial->order }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-khara-gray-600 font-sans">Statut:</span>
                        @if($testimonial->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-sans font-semibold">Actif</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-sans font-semibold">Inactif</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-khara-gray-600 font-sans">Créé le:</span>
                        <span class="text-sm font-sans">{{ $testimonial->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

