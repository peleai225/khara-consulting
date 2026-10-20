# Design System - Khara Consulting

## Vue d'ensemble

Ce document décrit le design system du site Khara Consulting, basé sur les exigences du cahier des charges.

## Identité visuelle

### Slogan
**"Beyond and Further"**

### Couleurs principales

#### Palette Rouge (Corporate Premium)
- `khara-red-50`: #fef2f2
- `khara-red-100`: #fee2e2
- `khara-red-200`: #fecaca
- `khara-red-300`: #fca5a5
- `khara-red-400`: #f87171
- `khara-red-500`: #ef4444 (Rouge principal)
- `khara-red-600`: #dc2626 (Rouge foncé - utilisé pour les boutons)
- `khara-red-700`: #b91c1c
- `khara-red-800`: #991b1b
- `khara-red-900`: #7f1d1d
- `khara-red-950`: #450a0a

#### Blanc et nuances
- `khara-white`: #ffffff
- `khara-cream`: #fefefe
- `khara-off-white`: #fafafa

#### Gris neutres
- `khara-gray-50` à `khara-gray-900`: Palette complète de gris pour textes et backgrounds

#### Accents africains contemporains
- `khara-gold`: #d4af37
- `khara-gold-light`: #f4e4bc

### Typographie

#### Polices
- **Sans-serif principale**: Inter (pour le corps de texte)
- **Display**: Poppins (pour les titres)

#### Hiérarchie
- `h1`: 4xl md:5xl lg:6xl
- `h2`: 3xl md:4xl lg:5xl
- `h3`: 2xl md:3xl
- `h4`: xl md:2xl

## Composants

### Boutons

#### Bouton principal
```html
<button class="btn-primary">Action principale</button>
```

#### Bouton principal large
```html
<button class="btn-primary-lg">Action principale</button>
```

#### Bouton secondaire
```html
<button class="btn-secondary">Action secondaire</button>
```

#### Bouton outline
```html
<button class="btn-outline">Action tertiaire</button>
```

### Cards
```html
<div class="card">
    <!-- Contenu -->
</div>
```

### Badges
```html
<span class="badge-red">Badge</span>
```

### Inputs
```html
<input type="text" class="input" placeholder="Texte">
```

### Sections

#### Container de section
```html
<div class="section-container">
    <!-- Contenu -->
</div>
```

#### Section avec espacement
```html
<section class="section">
    <!-- Contenu -->
</section>
```

## Structure des pages

### Layout principal
- Header avec navigation sticky
- Footer avec liens et informations de contact
- Menu mobile responsive

### Pages disponibles
1. **Accueil** (`/`) - Hero section, services, mission/vision
2. **Contact** (`/contact`) - Formulaire de contact amélioré

## Valeurs reflétées dans le design

- **Excellence**: Design premium, soigné, professionnel
- **Innovation**: Interface moderne, animations subtiles
- **Éthique**: Transparence dans les informations, clarté
- **Impact social**: Couleurs chaleureuses, approche inclusive

## Responsive Design

Le design est entièrement responsive avec des breakpoints :
- Mobile: < 640px
- Tablet: 640px - 1024px
- Desktop: > 1024px

## Utilisation

### Classes Tailwind personnalisées

Les couleurs peuvent être utilisées avec les préfixes standards de Tailwind :
- `bg-khara-red-600` pour un background rouge
- `text-khara-red-600` pour un texte rouge
- `border-khara-red-600` pour une bordure rouge

### Exemple complet

```html
<div class="section bg-white">
    <div class="section-container">
        <h2 class="text-4xl font-display font-bold mb-4">
            Titre avec <span class="text-gradient">gradient</span>
        </h2>
        <button class="btn-primary">Action</button>
    </div>
</div>
```

