@extends('layouts.admin')

@section('title', 'Paramètres - Admin Khara Consulting')
@section('page-title', 'Paramètres')

@php
    $getSetting = function($key) use ($settingsByKey) {
        return $settingsByKey[$key] ?? null;
    };
    $getValue = function($key) use ($settingsByKey) {
        $s = $settingsByKey[$key] ?? null;
        return $s ? old("settings.{$key}", $s->value) : '';
    };
@endphp

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settings-form">
    @csrf
    @method('PUT')

    <div class="max-w-5xl mx-auto pb-32">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">General Settings</h1>
            <p class="text-slate-500 mt-1">Configurez les paramètres globaux et la marque de la plateforme.</p>
        </div>

        <!-- Tabs -->
        <div class="border-b border-slate-200 mb-8 flex gap-8 overflow-x-auto">
            <button type="button" data-tab="general" class="settings-tab px-1 py-4 text-sm font-bold border-b-2 border-khara-red text-khara-red transition-all whitespace-nowrap">
                General
            </button>
            <button type="button" data-tab="seo" class="settings-tab px-1 py-4 text-sm font-medium text-slate-500 hover:text-slate-700 transition-all whitespace-nowrap">
                SEO
            </button>
            <button type="button" data-tab="social" class="settings-tab px-1 py-4 text-sm font-medium text-slate-500 hover:text-slate-700 transition-all whitespace-nowrap">
                Réseaux sociaux
            </button>
            <button type="button" data-tab="email" class="settings-tab px-1 py-4 text-sm font-medium text-slate-500 hover:text-slate-700 transition-all whitespace-nowrap">
                Email
            </button>
            <button type="button" data-tab="display" class="settings-tab px-1 py-4 text-sm font-medium text-slate-500 hover:text-slate-700 transition-all whitespace-nowrap">
                Affichage
            </button>
        </div>

        <!-- Tab Content -->
        <div class="space-y-12">
            <!-- General Tab -->
            <div id="tab-general" class="settings-tab-content">
                <!-- Branding -->
                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">palette</span>
                        Identité visuelle
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @if($logoSetting = $getSetting('company_logo'))
                        <div class="space-y-4">
                            <label class="block">
                                <span class="text-sm font-semibold text-slate-700 mb-2 block">Logo du site</span>
                                <div class="flex items-center gap-6">
                                    <div class="size-24 rounded-lg border-2 border-khara-red/30 bg-white flex items-center justify-center p-2 shadow-sm overflow-hidden relative">
                                        <img id="logo-preview" src="{{ $logoSetting->value ? asset('storage/' . $logoSetting->value) : '' }}" alt="Logo" class="max-w-full max-h-full object-contain {{ !$logoSetting->value ? 'hidden' : '' }}">
                                        <span class="material-symbols-outlined text-slate-300 text-4xl {{ $logoSetting->value ? 'hidden' : '' }}" id="logo-placeholder">image</span>
                                    </div>
                                    <div>
                                        <input type="file" name="settings[company_logo]" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-khara-red/10 file:text-khara-red hover:file:bg-khara-red/20" id="logo-input">
                                        <p class="text-xs text-slate-500 mt-1">PNG, JPG. Laisser vide pour conserver.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endif
                        @if($faviconSetting = $getSetting('company_favicon'))
                        <div class="space-y-4">
                            <label class="block">
                                <span class="text-sm font-semibold text-slate-700 mb-2 block">Favicon</span>
                                <div class="flex items-center gap-6">
                                    <div class="size-12 rounded-lg border-2 border-khara-red/30 bg-white flex items-center justify-center p-1 shadow-sm overflow-hidden">
                                        <img id="favicon-preview" src="{{ $faviconSetting->value ? asset('storage/' . $faviconSetting->value) : '' }}" alt="Favicon" class="max-w-full max-h-full object-contain {{ !$faviconSetting->value ? 'hidden' : '' }}">
                                        <span class="material-symbols-outlined text-slate-300 text-2xl {{ $faviconSetting->value ? 'hidden' : '' }}" id="favicon-placeholder">public</span>
                                    </div>
                                    <div>
                                        <input type="file" name="settings[company_favicon]" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-khara-red/10 file:text-khara-red hover:file:bg-khara-red/20" id="favicon-input">
                                        <p class="text-xs text-slate-500 mt-1">ICO ou PNG 32×32</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endif
                    </div>
                </section>

                <div class="h-px bg-slate-200 w-full my-8"></div>

                <!-- Site Information -->
                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">info</span>
                        Informations du site
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(['company_name' => 'Nom du site', 'company_slogan' => 'Slogan'] as $key => $label)
                            @if($s = $getSetting($key))
                            <div class="space-y-2">
                                <label for="setting_{{ $key }}" class="text-sm font-semibold text-slate-700">{{ $label }}</label>
                                <input type="text" id="setting_{{ $key }}" name="settings[{{ $key }}]" value="{{ $getValue($key) }}"
                                    class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none transition-all">
                            </div>
                            @endif
                        @endforeach
                        @if($s = $getSetting('company_email'))
                        <div class="space-y-2">
                            <label for="setting_company_email" class="text-sm font-semibold text-slate-700">Email de contact</label>
                            <input type="email" id="setting_company_email" name="settings[company_email]" value="{{ $getValue('company_email') }}"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none transition-all">
                        </div>
                        @endif
                        @if($s = $getSetting('company_phone'))
                        <div class="space-y-2">
                            <label for="setting_company_phone" class="text-sm font-semibold text-slate-700">Téléphone</label>
                            <input type="tel" id="setting_company_phone" name="settings[company_phone]" value="{{ $getValue('company_phone') }}"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none transition-all">
                        </div>
                        @endif
                        @if($s = $getSetting('company_whatsapp'))
                        <div class="space-y-2">
                            <label for="setting_company_whatsapp" class="text-sm font-semibold text-slate-700">WhatsApp</label>
                            <input type="text" id="setting_company_whatsapp" name="settings[company_whatsapp]" value="{{ $getValue('company_whatsapp') }}"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none transition-all">
                        </div>
                        @endif
                        @if($s = $getSetting('company_address'))
                        <div class="md:col-span-2 space-y-2">
                            <label for="setting_company_address" class="text-sm font-semibold text-slate-700">Adresse</label>
                            <textarea id="setting_company_address" name="settings[company_address]" rows="2"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none transition-all">{{ $getValue('company_address') }}</textarea>
                        </div>
                        @endif
                    </div>
                </section>
            </div>

            <!-- SEO Tab -->
            <div id="tab-seo" class="settings-tab-content hidden">
                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">search</span>
                        Configuration SEO
                    </h3>
                    <div class="space-y-6 max-w-2xl">
                        @foreach(isset($settings['seo']) ? $settings['seo'] : [] as $setting)
                        <div class="space-y-2 {{ in_array($setting->type, ['textarea']) ? 'md:col-span-2' : '' }}">
                            <label for="setting_{{ $setting->key }}" class="text-sm font-semibold text-slate-700">{{ $setting->label }}</label>
                            @if($setting->type === 'textarea')
                                <textarea id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" rows="3"
                                    class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none">{{ $getValue($setting->key) }}</textarea>
                            @else
                                <input type="{{ $setting->type === 'email' ? 'email' : 'text' }}" id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $getValue($setting->key) }}"
                                    class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none">
                            @endif
                            @if($setting->description)
                                <p class="text-xs text-slate-500">{{ $setting->description }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <!-- Social Tab -->
            <div id="tab-social" class="settings-tab-content hidden">
                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">share</span>
                        Réseaux sociaux
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php $socialIcons = ['social_facebook' => 'social_leaderboard', 'social_twitter' => 'tag', 'social_linkedin' => 'groups', 'social_instagram' => 'photo_camera', 'social_youtube' => 'play_circle']; @endphp
                        @foreach(isset($settings['social']) ? $settings['social'] : [] as $setting)
                        <div class="flex items-center gap-3 p-4 bg-white rounded-lg border border-slate-200 hover:border-khara-red/30 transition-colors">
                            <span class="material-symbols-outlined text-khara-red">{{ $socialIcons[$setting->key] ?? 'link' }}</span>
                            <div class="flex-1 min-w-0">
                                <label for="setting_{{ $setting->key }}" class="text-xs font-semibold text-slate-500 block">{{ $setting->label }}</label>
                                <input type="url" id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $getValue($setting->key) }}" placeholder="https://..."
                                    class="w-full border-0 p-0 text-sm font-medium text-slate-900 focus:ring-0 placeholder:text-slate-400">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <!-- Email Tab -->
            <div id="tab-email" class="settings-tab-content hidden">
                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">mail</span>
                        Configuration email
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(isset($settings['email']) ? $settings['email'] : [] as $setting)
                        <div class="space-y-2">
                            <label for="setting_{{ $setting->key }}" class="text-sm font-semibold text-slate-700">{{ $setting->label }}</label>
                            <input type="{{ $setting->type === 'email' ? 'email' : 'text' }}" id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $getValue($setting->key) }}"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none">
                            @if($setting->description)
                                <p class="text-xs text-slate-500">{{ $setting->description }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <!-- Display Tab -->
            <div id="tab-display" class="settings-tab-content hidden">
                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-khara-red">visibility</span>
                        Affichage
                    </h3>
                    <div class="space-y-6 max-w-2xl">
                        @foreach(isset($settings['display']) ? $settings['display'] : [] as $setting)
                        <div class="{{ $setting->type === 'boolean' ? '' : 'space-y-2' }}">
                            @if($setting->type === 'boolean')
                            <div class="flex items-center justify-between p-4 bg-khara-red/5 rounded-lg border border-khara-red/20">
                                <div>
                                    <p class="font-bold text-slate-900">{{ $setting->label }}</p>
                                    @if($setting->description)
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $setting->description }}</p>
                                    @endif
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                    <input type="checkbox" name="settings[{{ $setting->key }}]" value="1" {{ $getValue($setting->key) ? 'checked' : '' }}
                                        class="sr-only peer">
                                    <div class="w-12 h-6 bg-slate-200 peer-focus:ring-2 peer-focus:ring-khara-red/30 rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-khara-red"></div>
                                </label>
                            </div>
                            @else
                            <label for="setting_{{ $setting->key }}" class="text-sm font-semibold text-slate-700">{{ $setting->label }}</label>
                            <textarea id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" rows="3"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm focus:border-khara-red focus:ring-2 focus:ring-khara-red/20 outline-none mt-2">{{ $getValue($setting->key) }}</textarea>
                            @if($setting->description)
                                <p class="text-xs text-slate-500 mt-1">{{ $setting->description }}</p>
                            @endif
                            @endif
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Sticky Footer -->
    <footer class="fixed bottom-0 left-0 right-0 lg:left-64 border-t border-slate-200 bg-white/95 backdrop-blur-md px-4 lg:px-8 py-4 z-50">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <p class="text-slate-500 text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-slate-400 text-base">info</span>
                Tous les onglets sont enregistrés ensemble
            </p>
            <div class="flex gap-3">
                <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 border border-slate-300 hover:bg-slate-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-khara-red text-white hover:bg-khara-red/90 shadow-lg shadow-khara-red/20 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">save</span>
                    Enregistrer
                </button>
            </div>
        </div>
    </footer>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.settings-tab');
    const contents = document.querySelectorAll('.settings-tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.tab;
            tabs.forEach(t => {
                t.classList.remove('border-b-2', 'border-khara-red', 'text-khara-red', 'font-bold');
                t.classList.add('text-slate-500', 'font-medium');
            });
            tab.classList.add('border-b-2', 'border-khara-red', 'text-khara-red', 'font-bold');
            tab.classList.remove('text-slate-500', 'font-medium');

            contents.forEach(c => {
                c.classList.add('hidden');
                if (c.id === 'tab-' + target) c.classList.remove('hidden');
            });
        });
    });

    // Image preview
    document.getElementById('logo-input')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('logo-preview');
        const placeholder = document.getElementById('logo-placeholder');
        if (file && preview) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder?.classList.add('hidden');
        }
    });
    document.getElementById('favicon-input')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('favicon-preview');
        const placeholder = document.getElementById('favicon-placeholder');
        if (file && preview) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder?.classList.add('hidden');
        }
    });
});
</script>
@endpush
@endsection
