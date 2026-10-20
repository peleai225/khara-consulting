<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['Quels types d\'organisations accompagnez-vous ?', "Nous accompagnons aussi bien les porteurs de projet et jeunes entreprises que les PME établies, les institutions et les organisations qui veulent structurer leur croissance ou monter en compétences.", 'Services', 1],
            ['Dans quelles zones intervenez-vous ?', "Nous intervenons principalement en Afrique francophone, en présentiel comme à distance. Pour les missions en dehors de notre zone habituelle, nous organisons des interventions sur mesure.", 'Services', 2],
            ['Proposez-vous des formations sur mesure ?', "Oui. Chaque programme de formation est conçu à partir de vos enjeux réels. Nous adaptons les contenus, le format et la durée à votre contexte et à votre niveau.", 'Services', 3],

            ['Comment se déroule une mission type ?', "En quatre temps : écoute et diagnostic, proposition d'une stratégie sur mesure, mise en œuvre à vos côtés, puis suivi et mesure des résultats. Vous gardez la visibilité à chaque étape.", 'Déroulement', 4],
            ['Combien de temps dure un accompagnement ?', "Cela dépend de vos objectifs : d'une journée de formation à un accompagnement de plusieurs mois. Nous définissons ensemble le périmètre et le calendrier lors du premier échange.", 'Déroulement', 5],

            ['Comment demander un devis ?', "Remplissez le formulaire de contact en décrivant votre besoin, ou écrivez-nous directement. Nous revenons vers vous sous 24 h avec une proposition adaptée.", 'Modalités', 6],
            ['Le premier échange est-il payant ?', "Non. Le premier échange est gratuit et sans engagement : il nous permet de comprendre votre besoin et de vous orienter vers la meilleure approche.", 'Modalités', 7],
        ];

        foreach ($faqs as [$q, $a, $cat, $order]) {
            Faq::updateOrCreate(
                ['question' => $q],
                ['answer' => $a, 'category' => $cat, 'order' => $order, 'is_active' => true],
            );
        }
    }
}
