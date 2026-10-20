<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Offre réelle de Khara Consulting (domaine issu du formulaire de contact).
     * Les descriptions sont rédigées ; les chiffres/preuves restent à fournir.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Formation professionnelle',
                'slug' => 'formation-professionnelle',
                'icon' => 'graduation',
                'description' => "Des formations concrètes qui transforment vos équipes en acteurs de la performance — pensées pour le terrain, pas pour la théorie.",
                'content' => "Nous concevons et animons des parcours de formation sur mesure : leadership, gestion, vente, compétences digitales et soft skills. Chaque session est bâtie à partir de vos enjeux réels, avec des cas pratiques et un suivi post-formation pour ancrer les acquis.",
                'order' => 1,
            ],
            [
                'title' => 'Accompagnement entrepreneurial',
                'slug' => 'accompagnement-entrepreneurial',
                'icon' => 'rocket',
                'description' => "De l'idée au lancement, puis à la croissance : un accompagnement qui sécurise chaque étape de votre projet.",
                'content' => "Business model, plan d'affaires, recherche de financement, structuration juridique et stratégie de croissance. Nous accompagnons porteurs de projets et jeunes entreprises avec méthode, pour passer de l'intuition à une entreprise solide et finançable.",
                'order' => 2,
            ],
            [
                'title' => 'Ressources humaines & recrutement',
                'slug' => 'ressources-humaines-recrutement',
                'icon' => 'users',
                'description' => "Recrutez les bonnes personnes et faites grandir vos talents, avec des process RH clairs et outillés.",
                'content' => "Recrutement et sélection, définition de postes, grilles d'évaluation, politique de rémunération, gestion de la performance et plans de développement. Nous installons des pratiques RH qui attirent, fidélisent et font progresser vos équipes.",
                'order' => 3,
            ],
            [
                'title' => "Structuration & croissance d'entreprise",
                'slug' => 'structuration-croissance',
                'icon' => 'chart',
                'description' => "Organisez votre entreprise pour durer : process, pilotage et organisation au service de votre croissance.",
                'content' => "Diagnostic organisationnel, formalisation des process, tableaux de bord de pilotage, répartition des rôles et gouvernance. Nous structurons votre entreprise pour qu'elle grandisse sans perdre en maîtrise ni en qualité.",
                'order' => 4,
            ],
            [
                'title' => 'Audit & conseil stratégique',
                'slug' => 'audit-conseil-strategique',
                'icon' => 'shield',
                'description' => "Un regard extérieur, rigoureux et bienveillant, pour décider avec lucidité et agir avec impact.",
                'content' => "Audit organisationnel, opérationnel et de performance, analyse stratégique et recommandations priorisées. Nous vous aidons à voir clair sur vos forces et vos angles morts, puis à transformer le diagnostic en plan d'action concret.",
                'order' => 5,
            ],
            [
                'title' => 'Transformation & performance',
                'slug' => 'transformation-performance',
                'icon' => 'spark',
                'description' => "Alignez stratégie, organisation et équipes pour une performance durable, mesurable et partagée.",
                'content' => "Conduite du changement, optimisation des opérations, culture de la performance et accompagnement des dirigeants. Nous installons les conditions d'une transformation qui tient dans le temps, portée par vos équipes.",
                'order' => 6,
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['is_active' => true]),
            );
        }
    }
}
