<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use Illuminate\Database\Seeder;

class ContentBlockSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = [
            // Accueil — piliers
            ['home_pillar', 'graduation', 'Formations terrain', 'Des compétences directement actionnables.'],
            ['home_pillar', 'rocket', "De l'idée à l'impact", 'Un accompagnement de bout en bout.'],
            ['home_pillar', 'chart', 'Croissance maîtrisée', 'Des organisations qui tiennent dans le temps.'],
            ['home_pillar', 'shield', 'Ancrage africain', 'Une expertise au plus près de vos réalités.'],

            // Accueil — méthode
            ['home_method', null, 'Écoute & diagnostic', 'Nous comprenons votre contexte, vos enjeux et vos objectifs réels.'],
            ['home_method', null, 'Stratégie sur mesure', "Nous concevons un plan d'action priorisé, adapté à vos moyens."],
            ['home_method', null, 'Mise en œuvre', 'Nous agissons à vos côtés, sur le terrain, avec vos équipes.'],
            ['home_method', null, 'Suivi & résultats', "Nous mesurons l'impact et ancrons les acquis dans la durée."],

            // Services — pourquoi Khara
            ['services_why', 'shield', 'Sur mesure, jamais sur étagère', "Chaque mission part de votre contexte réel, pas d'un modèle générique."],
            ['services_why', 'users', 'À vos côtés, sur le terrain', 'Nous agissons avec vos équipes, pas seulement en salle de réunion.'],
            ['services_why', 'chart', 'Orientés impact', "Nous mesurons les résultats et ancrons les acquis dans la durée."],
        ];

        foreach ($blocks as $i => [$zone, $icon, $title, $subtitle]) {
            ContentBlock::updateOrCreate(
                ['zone' => $zone, 'title' => $title],
                ['icon' => $icon, 'subtitle' => $subtitle, 'order' => $i, 'is_active' => true],
            );
        }
    }
}
