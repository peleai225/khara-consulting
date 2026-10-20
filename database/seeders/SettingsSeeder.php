<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Paramètres Généraux
            ['key' => 'company_name', 'value' => 'Khara Consulting', 'group' => 'general', 'type' => 'text', 'label' => 'Nom de l\'entreprise', 'description' => 'Nom officiel de l\'entreprise', 'order' => 1],
            ['key' => 'company_slogan', 'value' => 'Beyond and Further', 'group' => 'general', 'type' => 'text', 'label' => 'Slogan', 'description' => 'Slogan de l\'entreprise', 'order' => 2],
            ['key' => 'company_logo', 'value' => null, 'group' => 'general', 'type' => 'image', 'label' => 'Logo', 'description' => 'Logo de l\'entreprise', 'order' => 3],
            ['key' => 'company_favicon', 'value' => null, 'group' => 'general', 'type' => 'image', 'label' => 'Favicon', 'description' => 'Icône de l\'onglet navigateur', 'order' => 4],
            ['key' => 'company_address', 'value' => '', 'group' => 'general', 'type' => 'textarea', 'label' => 'Adresse', 'description' => 'Adresse complète de l\'entreprise', 'order' => 5],
            ['key' => 'company_phone', 'value' => '', 'group' => 'general', 'type' => 'text', 'label' => 'Téléphone', 'description' => 'Numéro de téléphone principal', 'order' => 6],
            ['key' => 'company_email', 'value' => 'contact@khara-consulting.com', 'group' => 'general', 'type' => 'email', 'label' => 'Email de contact', 'description' => 'Email principal de contact', 'order' => 7],
            ['key' => 'company_whatsapp', 'value' => '', 'group' => 'general', 'type' => 'text', 'label' => 'WhatsApp', 'description' => 'Numéro WhatsApp', 'order' => 8],

            // Configuration Email
            ['key' => 'mail_from_name', 'value' => 'Khara Consulting', 'group' => 'email', 'type' => 'text', 'label' => 'Nom expéditeur', 'description' => 'Nom affiché dans les emails', 'order' => 1],
            ['key' => 'mail_from_address', 'value' => 'noreply@khara-consulting.com', 'group' => 'email', 'type' => 'email', 'label' => 'Email expéditeur', 'description' => 'Adresse email d\'envoi', 'order' => 2],
            ['key' => 'mail_notification_to', 'value' => 'admin@khara-consulting.com', 'group' => 'email', 'type' => 'email', 'label' => 'Email notifications', 'description' => 'Email pour recevoir les notifications', 'order' => 3],

            // SEO
            ['key' => 'meta_title', 'value' => 'Khara Consulting - Excellence • Innovation • Impact', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title', 'description' => 'Titre SEO de la page d\'accueil', 'order' => 1],
            ['key' => 'meta_description', 'value' => 'Khara Consulting forme, outille et propulse les talents et entrepreneurs vers une performance durable en Afrique et ailleurs.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description', 'description' => 'Description SEO', 'order' => 2],
            ['key' => 'meta_keywords', 'value' => 'consulting, formation, entrepreneur, afrique, performance', 'group' => 'seo', 'type' => 'text', 'label' => 'Mots-clés', 'description' => 'Mots-clés SEO (séparés par des virgules)', 'order' => 3],
            ['key' => 'google_analytics', 'value' => '', 'group' => 'seo', 'type' => 'text', 'label' => 'Google Analytics ID', 'description' => 'ID de suivi Google Analytics', 'order' => 4],

            // Réseaux Sociaux
            ['key' => 'social_facebook', 'value' => '', 'group' => 'social', 'type' => 'url', 'label' => 'Facebook', 'description' => 'URL de la page Facebook', 'order' => 1],
            ['key' => 'social_twitter', 'value' => '', 'group' => 'social', 'type' => 'url', 'label' => 'Twitter/X', 'description' => 'URL du compte Twitter/X', 'order' => 2],
            ['key' => 'social_linkedin', 'value' => '', 'group' => 'social', 'type' => 'url', 'label' => 'LinkedIn', 'description' => 'URL de la page LinkedIn', 'order' => 3],
            ['key' => 'social_instagram', 'value' => '', 'group' => 'social', 'type' => 'url', 'label' => 'Instagram', 'description' => 'URL du compte Instagram', 'order' => 4],
            ['key' => 'social_youtube', 'value' => '', 'group' => 'social', 'type' => 'url', 'label' => 'YouTube', 'description' => 'URL de la chaîne YouTube', 'order' => 5],

            // Affichage
            ['key' => 'maintenance_mode', 'value' => '0', 'group' => 'display', 'type' => 'boolean', 'label' => 'Mode Maintenance', 'description' => 'Activer le mode maintenance', 'order' => 1],
            ['key' => 'maintenance_message', 'value' => 'Site en maintenance. Nous serons de retour bientôt.', 'group' => 'display', 'type' => 'textarea', 'label' => 'Message de maintenance', 'description' => 'Message affiché en mode maintenance', 'order' => 2],
        ];

        // NON destructif : on n'ajoute que les clés manquantes.
        // Les valeurs déjà configurées (téléphone, logo, réseaux…) ne sont jamais écrasées.
        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
