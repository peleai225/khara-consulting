<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Les administrateurs connectés et tout le back-office restent accessibles.
        if ($request->is('admin', 'admin/*') || Auth::check()) {
            return $next($request);
        }

        try {
            if (! Schema::hasTable('settings')) {
                return $next($request);
            }

            $enabled = filter_var(Setting::get('maintenance_mode', false), FILTER_VALIDATE_BOOLEAN);

            if ($enabled) {
                $message = Setting::get('maintenance_message')
                    ?: 'Site en maintenance. Nous serons de retour très bientôt.';

                return response()->view('errors.503', ['maintenanceMessage' => $message], 503);
            }
        } catch (\Throwable $e) {
            // En cas de souci (base indisponible), on laisse passer plutôt que de bloquer le site.
        }

        return $next($request);
    }
}
