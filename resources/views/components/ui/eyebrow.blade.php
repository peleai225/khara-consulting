@props(['tone' => 'red'])

<span {{ $attributes->merge(['class' => 'eyebrow' . ($tone === 'gold' ? ' eyebrow-gold' : '')]) }}>
    {{ $slot }}
</span>
