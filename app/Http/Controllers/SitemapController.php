<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        $services = Service::active()->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Page d'accueil
        $xml .= $this->url(url('/'), date('Y-m-d'), 'weekly', '1.0');

        // Pages statiques
        $staticPages = ['services', 'about', 'programs', 'contact', 'faq', 'realisations', 'legal.mentions', 'legal.privacy'];
        foreach ($staticPages as $page) {
            $xml .= $this->url(route($page), date('Y-m-d'), 'monthly', '0.8');
        }

        // Services (ancres)
        foreach ($services as $service) {
            $xml .= $this->url(route('services') . '#' . $service->slug, $service->updated_at->format('Y-m-d'), 'monthly', '0.7');
        }

        // Pages dynamiques actives
        foreach (Page::where('is_active', true)->get() as $p) {
            if ($p->slug === 'about') {
                continue; // déjà couverte par la route /about
            }
            $xml .= $this->url(route('page.show', $p->slug), $p->updated_at->format('Y-m-d'), 'monthly', '0.6');
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function url(string $loc, string $lastmod, string $freq, string $priority): string
    {
        return '  <url>' . "\n"
            . '    <loc>' . e($loc) . '</loc>' . "\n"
            . '    <lastmod>' . $lastmod . '</lastmod>' . "\n"
            . '    <changefreq>' . $freq . '</changefreq>' . "\n"
            . '    <priority>' . $priority . '</priority>' . "\n"
            . '  </url>' . "\n";
    }
}
