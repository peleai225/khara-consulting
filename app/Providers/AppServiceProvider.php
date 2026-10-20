<?php

namespace App\Providers;

use App\Models\Setting;
use App\View\Composers\SiteSettingsComposer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.app', 'home', 'faq', 'services', 'contact', 'about', 'programs', 'realisations', 'page', 'legal.mentions', 'legal.privacy', 'errors.404'], SiteSettingsComposer::class);

        // Seuls les super-administrateurs gèrent les comptes utilisateurs.
        Gate::define('manage-users', fn ($user) => $user->isSuperAdmin());

        // Expéditeur des emails piloté par les réglages du back-office (si renseignés).
        try {
            if (! $this->app->runningInConsole() && Schema::hasTable('settings')) {
                if ($fromAddress = Setting::get('mail_from_address')) {
                    config(['mail.from.address' => $fromAddress]);
                }
                if ($fromName = Setting::get('mail_from_name')) {
                    config(['mail.from.name' => $fromName]);
                }
            }
        } catch (\Throwable $e) {
            // Base indisponible (ex. première installation) : on garde la config .env.
        }
    }
}
