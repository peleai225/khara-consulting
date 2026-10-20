<?php

namespace App\View\Composers;

use App\Models\Setting;
use App\Models\Service;
use Illuminate\View\View;

class SiteSettingsComposer
{
    public function compose(View $view): void
    {
        $view->with([
            'siteLogo' => Setting::get('company_logo'),
            'siteFavicon' => Setting::get('company_favicon'),
            'siteName' => Setting::get('company_name', 'Khara Consulting'),
            'siteSlogan' => Setting::get('company_slogan', 'Beyond and Further'),
            'siteAddress' => Setting::get('company_address', ''),
            'sitePhone' => Setting::get('company_phone', ''),
            'siteEmail' => Setting::get('company_email', 'contact@khara-consulting.com'),
            'siteWhatsapp' => Setting::get('company_whatsapp', ''),
            'socialFacebook' => Setting::get('social_facebook', ''),
            'socialTwitter' => Setting::get('social_twitter', ''),
            'socialLinkedin' => Setting::get('social_linkedin', ''),
            'socialInstagram' => Setting::get('social_instagram', ''),
            'socialYoutube' => Setting::get('social_youtube', ''),
            'metaTitle' => Setting::get('meta_title', 'Khara Consulting - Beyond and Further'),
            'metaDescription' => Setting::get('meta_description', ''),
            'metaKeywords' => Setting::get('meta_keywords', ''),
            'siteGoogleAnalytics' => Setting::get('google_analytics', ''),
            'footerServices' => Service::active()->ordered()->limit(5)->get(),
        ]);
    }
}
