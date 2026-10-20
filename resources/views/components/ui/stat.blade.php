@props([
    'value' => '',
    'label' => '',
])

<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <span class="kc-stat-value">{{ $value }}</span>
    <span class="kc-stat-label">{{ $label }}</span>
</div>
