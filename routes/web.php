<?php

use Illuminate\Support\Facades\Route;

Route::get('/programs', [\App\Http\Controllers\ProgramsController::class, 'index'])->name('programs');

// Page de démonstration du design system (non indexée)
Route::view('/design-system', 'design-system')->name('design-system');

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\RealisationController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\ContentBlockController;
use App\Http\Controllers\RealisationsController;

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/realisations', [RealisationsController::class, 'index'])->name('realisations');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->middleware('throttle:8,1')->name('contact.submit');

// Pages dynamiques créées depuis le back-office (hors pages ayant déjà une route dédiée)
Route::get('/p/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page.show');

// Pages légales
Route::view('/mentions-legales', 'legal.mentions')->name('legal.mentions');
Route::view('/politique-de-confidentialite', 'legal.privacy')->name('legal.privacy');

// Sitemap
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// Routes d'authentification
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Routes protégées par authentification
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des contacts
        Route::get('contacts/export', [AdminContactController::class, 'exportCsv'])->name('contacts.export');
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
        Route::post('contacts/{contact}/toggle-read', [AdminContactController::class, 'toggleRead'])->name('contacts.toggle-read');
        
        // Paramètres
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        
        // Gestion des utilisateurs admin (super-administrateurs uniquement)
        Route::resource('users', UserController::class)->middleware('can:manage-users');
        
        // Gestion du contenu
        Route::resource('services', ServiceController::class);
        Route::resource('slides', SlideController::class);
        Route::post('slides/{slide}/toggle', [SlideController::class, 'toggle'])->name('slides.toggle');
        Route::resource('pages', PageController::class);
        Route::post('pages/{page}/toggle', [PageController::class, 'toggle'])->name('pages.toggle');
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('faqs', AdminFaqController::class);
        Route::resource('realisations', RealisationController::class);
        Route::post('realisations/{realisation}/toggle', [RealisationController::class, 'toggle'])->name('realisations.toggle');

        // Équipe
        Route::resource('team', TeamMemberController::class)->except(['show']);
        Route::post('team/{team}/toggle', [TeamMemberController::class, 'toggle'])->name('team.toggle');

        // Programmes
        Route::resource('programs', ProgramController::class)->except(['show']);
        Route::post('programs/{program}/toggle', [ProgramController::class, 'toggle'])->name('programs.toggle');

        // Chiffres clés
        Route::resource('stats', StatController::class)->except(['show']);
        Route::post('stats/{stat}/toggle', [StatController::class, 'toggle'])->name('stats.toggle');

        // Contenus de sections
        Route::resource('blocks', ContentBlockController::class)->except(['show']);
        Route::post('blocks/{block}/toggle', [ContentBlockController::class, 'toggle'])->name('blocks.toggle');
    });
});
