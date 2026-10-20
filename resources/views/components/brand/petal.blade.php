{{-- Forme "pétale" du logo Khara : squircle dont le coin bas-gauche est pointu (tip).
     Décorative — fill = currentColor pour hériter la couleur via les classes. --}}
<svg viewBox="0 0 100 100" fill="currentColor" aria-hidden="true" focusable="false"
     {{ $attributes->merge(['class' => 'block']) }}>
    <path d="M30,0 L70,0 A30,30 0 0 1 100,30 L100,70 A30,30 0 0 1 70,100 L0,100 L0,30 A30,30 0 0 1 30,0 Z" />
</svg>
