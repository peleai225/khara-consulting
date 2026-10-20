<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // firstOrCreate : ne touche pas une page « about » déjà présente en production.
        Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'À propos',
                'hero_title' => 'Révéler le potentiel, <span class="text-accent">au-delà des frontières</span>.',
                'hero_subtitle' => "Khara Consulting est né d'une conviction : l'Afrique francophone regorge de talents et d'entreprises prêts à passer un cap. Notre rôle est de les former, de les outiller et de les propulser — beyond and further.",
                'mission' => "Accompagner les entreprises et les entrepreneurs d'Afrique francophone dans leur montée en compétences, leur structuration et leur croissance, avec méthode, exigence et proximité.",
                'vision' => "Un continent où chaque talent et chaque organisation dispose des outils pour exprimer son plein potentiel et aller au-delà de ses limites.",
                'values' => ['Excellence', 'Innovation', 'Éthique', 'Impact social'],
                'meta_title' => 'À propos — Khara Consulting',
                'meta_description' => "Notre mission, notre vision et nos valeurs au service des talents et des entreprises d'Afrique francophone.",
                'is_active' => true,
            ],
        );
    }
}
