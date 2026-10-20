@extends('layouts.app')

@section('title', 'Contact — ' . ($siteName ?? 'Khara Consulting'))
@section('description', 'Parlons de votre projet. Réponse sous 24 h. Formation, accompagnement et conseil en Afrique francophone.')

@section('content')

{{-- ===================== PAGE HERO ===================== --}}
<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-16 md:py-20">
        <div class="max-w-3xl">
            <x-ui.eyebrow class="kc-reveal">Contact</x-ui.eyebrow>
            <h1 class="kc-reveal kc-reveal-2 mt-5 text-4xl sm:text-5xl lg:text-6xl text-khara-slate">
                Parlons de <span class="text-accent">votre projet</span>.
            </h1>
            <p class="kc-reveal kc-reveal-3 mt-6 text-lg text-khara-gray-600 leading-relaxed">
                Un premier échange gratuit et sans engagement. Décrivez-nous votre besoin, nous revenons vers vous sous 24 h.
            </p>
        </div>
    </div>
</section>

<section class="section bg-khara-white-off">
    <div class="section-container grid lg:grid-cols-[0.9fr_1.1fr] gap-12 lg:gap-16 items-start">

        {{-- Coordonnées --}}
        <div class="kc-reveal">
            <h2 class="text-2xl mb-6">Nos coordonnées</h2>
            <div class="space-y-5">
                @if(!empty($sitePhone))
                    <a href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}" class="flex items-start gap-4 group">
                        <span class="kc-check w-11 h-11 flex-shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a.75.75 0 0 1-.936.258 11.59 11.59 0 0 1-5.12-5.12.75.75 0 0 1 .258-.936l1.293-.97a1.125 1.125 0 0 0 .417-1.173L8.84 4.78a1.125 1.125 0 0 0-1.091-.852H6.375A2.25 2.25 0 0 0 4.125 6.18"/></svg></span>
                        <span><span class="block text-sm text-khara-gray-500">Téléphone</span><span class="block font-semibold text-khara-slate group-hover:text-khara-red transition-colors">{{ $sitePhone }}</span></span>
                    </a>
                @endif
                @if(!empty($siteEmail))
                    <a href="mailto:{{ $siteEmail }}" class="flex items-start gap-4 group">
                        <span class="kc-check w-11 h-11 flex-shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6"/></svg></span>
                        <span><span class="block text-sm text-khara-gray-500">Email</span><span class="block font-semibold text-khara-slate group-hover:text-khara-red transition-colors">{{ $siteEmail }}</span></span>
                    </a>
                @endif
                <div class="flex items-start gap-4">
                    <span class="kc-check w-11 h-11 flex-shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-6-5.686-6-10a6 6 0 1 1 12 0c0 4.314-6 10-6 10z"/><circle cx="12" cy="11" r="2"/></svg></span>
                    <span><span class="block text-sm text-khara-gray-500">Bureau</span><span class="block font-semibold text-khara-slate">{{ $siteAddress ?: '[À REMPLACER : adresse]' }}</span></span>
                </div>
            </div>

            <div class="mt-8 p-6 rounded-[var(--radius-kc-lg)] bg-khara-cream border border-khara-red-100">
                <p class="flex items-center gap-2 font-semibold text-khara-slate">
                    <span class="kc-check"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                    Réponse garantie sous 24 h
                </p>
                <p class="mt-2 text-sm text-khara-gray-600">Du lundi au vendredi. Un premier échange gratuit pour cadrer votre besoin.</p>
            </div>
        </div>

        {{-- Formulaire --}}
        <div class="card kc-reveal kc-reveal-2 !p-6 sm:!p-10">
            @if ($errors->any())
                <div role="alert" class="mb-6 rounded-[var(--radius-kc-md)] border border-khara-red-200 bg-khara-red-50 text-khara-red-800 px-5 py-4">
                    <p class="font-semibold">Veuillez corriger les points suivants :</p>
                    <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5" novalidate>
                @csrf
                {{-- Honeypot anti-spam : invisible pour les humains, rempli par les bots --}}
                <div class="absolute left-[-9999px]" aria-hidden="true">
                    <label for="website">Ne pas remplir ce champ</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="input-label" for="name">Nom complet <span class="text-khara-red">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="input @error('name') border-khara-red @enderror" placeholder="Votre nom">
                    </div>
                    <div>
                        <label class="input-label" for="email">Email <span class="text-khara-red">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="input @error('email') border-khara-red @enderror" placeholder="vous@exemple.ci">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="input-label" for="phone">Téléphone <span class="text-khara-red">*</span></label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required class="input @error('phone') border-khara-red @enderror" placeholder="+225 ...">
                    </div>
                    <div>
                        <label class="input-label" for="whatsapp">WhatsApp <span class="text-khara-gray-400 font-normal">(optionnel)</span></label>
                        <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" class="input" placeholder="+225 ...">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="input-label" for="type">Vous êtes <span class="text-khara-red">*</span></label>
                        <select id="type" name="type" required class="input @error('type') border-khara-red @enderror">
                            <option value="">Sélectionnez votre profil</option>
                            @foreach (['entrepreneur' => 'Entrepreneur / Porteur de projet', 'entreprise' => 'Entreprise / DRH', 'professionnel' => 'Professionnel / Salarié', 'etudiant' => 'Étudiant / Jeune diplômé', 'autre' => 'Autre'] as $v => $label)
                                <option value="{{ $v }}" {{ old('type') == $v ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="input-label" for="budget">Budget estimé <span class="text-khara-gray-400 font-normal">(optionnel)</span></label>
                        <select id="budget" name="budget" class="input">
                            <option value="">À définir ensemble</option>
                            @foreach (['<500k' => 'Moins de 500 000 FCFA', '500k-1m' => '500 000 – 1 000 000 FCFA', '1m-3m' => '1 – 3 millions FCFA', '3m-5m' => '3 – 5 millions FCFA', '>5m' => 'Plus de 5 millions FCFA', 'discuter' => 'À discuter'] as $v => $label)
                                <option value="{{ $v }}" {{ old('budget') == $v ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <span class="input-label">Vos besoins <span class="text-khara-red">*</span></span>
                    <div class="grid sm:grid-cols-2 gap-x-6 gap-y-2.5 mt-1">
                        @foreach (['formation' => 'Formation', 'entrepreneuriat' => 'Accompagnement entrepreneurial', 'rh' => 'RH / recrutement', 'structuration' => 'Structuration / croissance', 'audit' => 'Audit', 'autre' => 'Autre'] as $v => $label)
                            <label class="flex items-center gap-2.5 text-khara-gray-700 cursor-pointer">
                                <input type="checkbox" name="needs[]" value="{{ $v }}" {{ in_array($v, old('needs', [])) ? 'checked' : '' }} class="w-4 h-4 rounded text-khara-red focus:ring-khara-red/40 border-khara-gray-300">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="input-label" for="message">Votre message <span class="text-khara-red">*</span></label>
                    <textarea id="message" name="message" rows="5" required minlength="50" class="input @error('message') border-khara-red @enderror" placeholder="Décrivez votre projet, votre contexte et vos objectifs (50 caractères min.)">{{ old('message') }}</textarea>
                </div>

                <label class="flex items-start gap-3 text-sm text-khara-gray-600 cursor-pointer">
                    <input type="checkbox" name="contact_consent" value="1" required {{ old('contact_consent') ? 'checked' : '' }} class="w-4 h-4 mt-0.5 rounded text-khara-red focus:ring-khara-red/40 border-khara-gray-300">
                    J'accepte d'être contacté(e) par Khara Consulting au sujet de ma demande.
                </label>
                <label class="flex items-start gap-3 text-sm text-khara-gray-600 cursor-pointer">
                    <input type="checkbox" name="privacy_consent" value="1" required {{ old('privacy_consent') ? 'checked' : '' }} class="w-4 h-4 mt-0.5 rounded text-khara-red focus:ring-khara-red/40 border-khara-gray-300">
                    J'accepte la politique de confidentialité.
                </label>

                <x-ui.button type="submit" variant="primary-lg" class="w-full">
                    Envoyer ma demande
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </x-ui.button>
            </form>
        </div>
    </div>
</section>

@endsection
