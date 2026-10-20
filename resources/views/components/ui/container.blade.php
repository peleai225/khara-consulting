{{-- Conteneur centré, gouttière 16px minimum --}}
<div {{ $attributes->merge(['class' => 'section-container']) }}>
    {{ $slot }}
</div>
