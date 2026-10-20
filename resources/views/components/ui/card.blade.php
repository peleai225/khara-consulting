@props([
    'feature' => false,
    'petal' => false,
])

<div {{ $attributes->merge(['class' => ($feature ? 'card-feature' : 'card') . ($petal ? ' has-petal' : '')]) }}>
    @if ($petal)
        <x-brand.petal class="petal-watermark w-40 h-40 -right-8 -bottom-8" />
    @endif
    {{ $slot }}
</div>
