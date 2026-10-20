<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $domaines = [
            ['graduation', 'Leadership & management', 'Encadrer, motiver et faire grandir ses équipes.'],
            ['rocket', 'Entrepreneuriat', 'Lancer, piloter et faire croître son activité.'],
            ['users', 'Ressources humaines', 'Recruter, évaluer et développer les talents.'],
            ['chart', 'Gestion & performance', 'Piloter son activité par les chiffres et les process.'],
            ['spark', 'Compétences digitales', 'Outils numériques et transformation digitale.'],
            ['shield', 'Soft skills', 'Communication, organisation et efficacité personnelle.'],
        ];
        foreach ($domaines as $i => [$icon, $title, $desc]) {
            Program::updateOrCreate(
                ['title' => $title, 'category' => 'domaine'],
                ['icon' => $icon, 'description' => $desc, 'order' => $i + 1, 'is_active' => true],
            );
        }

        $formats = [
            ['Intra-entreprise', "Sur mesure, dans vos locaux, pour vos équipes."],
            ['Inter-entreprises', "En session ouverte, pour monter en compétences avec d'autres professionnels."],
            ['À distance', "En ligne, où que vous soyez, avec le même niveau d'exigence."],
        ];
        foreach ($formats as $i => [$title, $desc]) {
            Program::updateOrCreate(
                ['title' => $title, 'category' => 'format'],
                ['description' => $desc, 'order' => $i + 1, 'is_active' => true],
            );
        }
    }
}
