{{-- Ondes KC : arcs concentriques en écho au chevron du logo.
     Décoratif, animé en douceur (désactivé si prefers-reduced-motion). --}}
<svg viewBox="0 0 200 200" fill="none" aria-hidden="true" focusable="false"
     {{ $attributes->merge(['class' => 'kc-arcs']) }}>
    <g stroke="currentColor" stroke-linecap="round" fill="none">
        <path class="kc-arc kc-arc-1" d="M70 40 L110 100 L70 160" stroke-width="3" opacity="0.9"/>
        <path class="kc-arc kc-arc-2" d="M95 25 L150 100 L95 175" stroke-width="2.5" opacity="0.55"/>
        <path class="kc-arc kc-arc-3" d="M120 12 L188 100 L120 188" stroke-width="2" opacity="0.3"/>
        <path class="kc-arc kc-arc-4" d="M145 2 L224 100 L145 198" stroke-width="1.5" opacity="0.16"/>
    </g>
</svg>
