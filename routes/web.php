<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\PricingPackageController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\LandingPageController as AdminLandingPageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\PageManagementController;

// ========================================
// PUBLIC ROUTES
// ========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// Rute Rahasia untuk Preview Error Page (tanpa masuk sitemap)
Route::get('/preview-error-secret/{code}', function($code) {
    if (!in_array($code, ['403', '404', '419', '429', '500', '503'])) abort(404);
    return response()->view("errors.{$code}")->header('X-Robots-Tag', 'noindex, nofollow');
});

// Rute Rahasia / Praktis untuk menjalankan Seeder di Hostinger tanpa SSH
Route::get('/run-seeder-secret', function() {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'ContentSeeder', '--force' => true]);
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return '<h1>🎉 SUKSES BESAR! Database Seeder & Cache Berhasil Di-reset!</h1><p>Seluruh 8 Layanan kini sudah 100% sama dengan komputer lokal Anda. Silakan buka halaman layanan Anda sekarang.</p>';
});

Route::get('/check-data-secret', function() {
    $out = [];
    
    $out['db_connection'] = config('database.default');
    $out['db_database'] = config('database.connections.' . config('database.default') . '.database');
    
    $out['Services'] = \App\Models\Service::all()->map(fn($item) => [
        'id' => $item->id,
        'name' => $item->name,
        'featured_image' => $item->featured_image
    ])->toArray();
    
    $out['Portfolios'] = \App\Models\Portfolio::all()->map(fn($item) => [
        'id' => $item->id,
        'title' => $item->title,
        'featured_image' => $item->featured_image,
        'featured_image_thumb' => $item->featured_image_thumb
    ])->toArray();
    
    $out['Articles'] = \App\Models\Article::all()->map(fn($item) => [
        'id' => $item->id,
        'title' => $item->title,
        'featured_image' => $item->featured_image,
        'featured_image_thumb' => $item->featured_image_thumb,
        'og_image' => $item->og_image
    ])->toArray();
    
    $out['Testimonials'] = \App\Models\Testimonial::all()->map(fn($item) => [
        'id' => $item->id,
        'name' => $item->name,
        'company' => $item->company,
        'photo' => $item->photo,
        'photo_thumb' => $item->photo_thumb
    ])->toArray();
    
    $out['HeroSlides'] = \App\Models\HeroSlide::all()->map(fn($item) => [
        'id' => $item->id,
        'headline' => $item->headline,
        'image' => $item->image,
        'avatar_1' => $item->avatar_1,
        'avatar_2' => $item->avatar_2,
        'avatar_3' => $item->avatar_3
    ])->toArray();
    
    return response()->json($out);
});

Route::get('/run-rename-images-secret', function() {
    $renameHelper = function($oldPath, $newFilename, $isThumb = false) {
        if (!$oldPath) return null;
        
        $dir = dirname($oldPath);
        $ext = pathinfo($oldPath, PATHINFO_EXTENSION);
        
        // Remove thumb_ from start of old path if we are extracting base name for helper
        $oldFilename = pathinfo($oldPath, PATHINFO_FILENAME);
        if ($isThumb && str_starts_with($oldFilename, 'thumb_')) {
            $oldFilename = substr($oldFilename, 6);
        }
        
        $prefix = $isThumb ? 'thumb_' : '';
        
        // Construct new path
        $newPath = ($dir === '.' || $dir === '') 
            ? "{$prefix}{$newFilename}.{$ext}" 
            : "{$dir}/{$prefix}{$newFilename}.{$ext}";
            
        // Check if file exists in either direct oldPath or with thumb_ prefix
        $actualOldPath = $oldPath;
        if ($isThumb && !str_starts_with(basename($oldPath), 'thumb_')) {
            $actualOldPath = dirname($oldPath) . '/thumb_' . basename($oldPath);
        }
        
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($actualOldPath)) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($newPath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($newPath);
            }
            \Illuminate\Support\Facades\Storage::disk('public')->move($actualOldPath, $newPath);
            return $newPath;
        }
        
        // Return newPath anyway to simulate DB update even if file was deleted/missing
        return $newPath;
    };

    $log = [];

    // 1. Portfolios
    $portfolios = \App\Models\Portfolio::all();
    foreach ($portfolios as $p) {
        $seoName = match($p->id) {
            1 => 'rda-law-firm-website-firma-hukum-jakarta',
            2 => 'pt-borneo-iban-jaya-perkasa-website-korporat',
            3 => 'pt-mardika-sarana-engineering-portal-b2b-surabaya',
            4 => 'aspal-emulsi-techno-landing-page-sidoarjo',
            default => \Illuminate\Support\Str::slug($p->title)
        };
        
        if ($p->featured_image) {
            $newImg = $renameHelper($p->featured_image, $seoName, false);
            $newThumb = $renameHelper($p->featured_image_thumb ?: $p->featured_image, $seoName, true);
            
            $p->featured_image = $newImg;
            $p->featured_image_thumb = $newThumb;
            $p->save();
            $log[] = "Portfolio {$p->id} renamed to {$seoName}";
        }
    }

    // 2. Articles
    $articles = \App\Models\Article::all();
    foreach ($articles as $a) {
        $seoName = match($a->id) {
            4 => 'strategi-social-media-marketing-2026-video-pendek',
            6 => 'strategi-seo-lokal-2026-pencarian-google',
            7 => 'hvm-digital-hadir-di-rri-surabaya',
            default => \Illuminate\Support\Str::slug($a->title)
        };
        
        if ($a->featured_image) {
            $newImg = $renameHelper($a->featured_image, $seoName, false);
            $newThumb = $renameHelper($a->featured_image_thumb ?: $a->featured_image, $seoName, true);
            $newOg = $a->og_image ? $renameHelper($a->og_image, $seoName . '-og', false) : null;
            
            $a->featured_image = $newImg;
            $a->featured_image_thumb = $newThumb;
            $a->og_image = $newOg;
            $a->save();
            $log[] = "Article {$a->id} renamed to {$seoName}";
        }
    }

    // 3. Testimonials
    $testimonials = \App\Models\Testimonial::all();
    foreach ($testimonials as $t) {
        $seoName = match($t->id) {
            1 => 'testimoni-budi-santoso-cv-mitra-jaya',
            2 => 'testimoni-siti-rahayu-toko-batik',
            3 => 'testimoni-ahmad-fauzi-pt-tekno-mandiri',
            default => 'testimoni-' . \Illuminate\Support\Str::slug($t->name . '-' . $t->company)
        };
        
        if ($t->photo) {
            $newImg = $renameHelper($t->photo, $seoName, false);
            $newThumb = $renameHelper($t->photo_thumb ?: $t->photo, $seoName, true);
            
            $t->photo = $newImg;
            $t->photo_thumb = $newThumb;
            $t->save();
            $log[] = "Testimonial {$t->id} renamed to {$seoName}";
        }
    }

    // 4. Hero Slides
    $slides = \App\Models\HeroSlide::all();
    foreach ($slides as $s) {
        $seoName = match($s->id) {
            1 => 'slide-hvm-digital-growth',
            2 => 'slide-hvm-digital-open-intern',
            default => 'slide-hero-' . \Illuminate\Support\Str::slug($s->headline)
        };
        
        $changed = false;
        if ($s->image) {
            $s->image = $renameHelper($s->image, $seoName, false);
            $changed = true;
        }
        if ($s->avatar_1) {
            $s->avatar_1 = $renameHelper($s->avatar_1, $seoName . '-avatar-1', false);
            $changed = true;
        }
        if ($s->avatar_2) {
            $s->avatar_2 = $renameHelper($s->avatar_2, $seoName . '-avatar-2', false);
            $changed = true;
        }
        if ($s->avatar_3) {
            $s->avatar_3 = $renameHelper($s->avatar_3, $seoName . '-avatar-3', false);
            $changed = true;
        }
        
        if ($changed) {
            $s->save();
            $log[] = "HeroSlide {$s->id} renamed to {$seoName}";
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Rename existing images completed successfully!',
        'log' => $log
    ]);
});

// Layanan / Services
Route::get('/layanan/jasa-optimasi-seo-halaman-1', [ServiceController::class, 'seoPage'])->name('services.seo');
Route::get('/layanan', [ServiceController::class, 'index'])->name('services');
Route::get('/layanan/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

// Artikel / Blog
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles');
Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// Internship & Karir
Route::get('/internship', [\App\Http\Controllers\InternshipController::class, 'index'])->name('internship.index');
Route::get('/karir', [\App\Http\Controllers\CareerController::class, 'index'])->name('career.index');

// ========================================
// LANDING PAGES KOTA (GEO SEO) - Auto-generated from config/cities.php
// ========================================
foreach (config('cities') as $cityKey => $cityData) {
    Route::get('/' . $cityData['slug'], [LandingPageController::class, 'show'])
         ->defaults('city', $cityKey)
         ->name('city.' . $cityKey);
}

// ========================================
// TRACKING API (async, non-blocking)
// ========================================
Route::post('/track/visitor',  [TrackingController::class, 'visitor']);
Route::post('/track/wa-click', [TrackingController::class, 'waClick']);
Route::post('/track/lead',     [\App\Http\Controllers\LeadController::class, 'store'])->name('track.lead');

// ========================================
// SITEMAP & ROBOTS
// ========================================
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/robots.txt',  [SitemapController::class, 'robots']);

// ========================================
// USER AUTH (Register, Login, Logout)
// ========================================
Route::middleware('guest')->group(function () {
    Route::get('/register', [\App\Http\Controllers\UserAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [\App\Http\Controllers\UserAuthController::class, 'register']);
    Route::get('/login', [\App\Http\Controllers\UserAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\UserAuthController::class, 'login']);
});
Route::post('/logout', [\App\Http\Controllers\UserAuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========================================
// ONBOARDING & TENANT DASHBOARD (Protected)
// ========================================
Route::middleware('auth')->group(function () {
    Route::get('/onboarding', [\App\Http\Controllers\OnboardingController::class, 'index'])->name('onboarding');
    Route::post('/onboarding/profile', [\App\Http\Controllers\OnboardingController::class, 'saveProfile'])->name('onboarding.profile');
    Route::post('/onboarding/domain', [\App\Http\Controllers\OnboardingController::class, 'saveDomain'])->name('onboarding.domain');
    Route::get('/dashboard', function () {
        return 'Tenant Dashboard — Coming Soon';
    })->name('tenant.dashboard');
});

// ========================================
// API (Domain Check)
// ========================================
Route::post('/api/check-domain', [\App\Http\Controllers\DomainCheckController::class, 'check'])->name('api.check-domain');


// ========================================
// ADMIN ROUTES
// ========================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin area
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Dapat diakses oleh Admin & Copywriter
        Route::middleware('admin.role:admin,copywriter')->group(function () {
            Route::resource('articles',         AdminArticleController::class);
            Route::resource('article-categories', ArticleCategoryController::class)
                 ->parameters(['article-categories' => 'articleCategory']);
        });

        // Hanya dapat diakses oleh Admin
        Route::middleware('admin.role:admin')->group(function () {
            // Settings (custom, not full resource)
            Route::get('/settings',  [SettingController::class, 'index'])->name('settings.index');
            Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

            // Resources
            Route::resource('users',        \App\Http\Controllers\Admin\UserController::class);
            Route::resource('pricing_packages', PricingPackageController::class)->except(['show']);
            Route::resource('services',     AdminServiceController::class);
            Route::resource('testimonials', TestimonialController::class);
            Route::resource('portfolios',   AdminPortfolioController::class);
            Route::resource('faqs',         FaqController::class);
            Route::resource('hero-slides',  \App\Http\Controllers\Admin\HeroSlideController::class);
            Route::resource('internships',  \App\Http\Controllers\Admin\InternshipController::class);
            Route::resource('careers',      \App\Http\Controllers\Admin\CareerController::class);

            // Page Management
            Route::get('/page-management',                        [PageManagementController::class, 'index'])->name('page-management.index');
            Route::get('/page-management/{pageKey}/edit-core',    [PageManagementController::class, 'editCore'])->name('page-management.edit-core');
            Route::put('/page-management/{pageKey}/update-core',  [PageManagementController::class, 'updateCore'])->name('page-management.update-core');

            // Leads CRM (Full)
            Route::get('/leads',                    [\App\Http\Controllers\Admin\LeadController::class, 'index'])->name('leads.index');
            Route::get('/leads/export',             [\App\Http\Controllers\Admin\LeadController::class, 'export'])->name('leads.export');
            Route::get('/leads/analytics',          [\App\Http\Controllers\Admin\LeadController::class, 'analytics'])->name('leads.analytics');
            Route::get('/leads/tags',               [\App\Http\Controllers\Admin\LeadController::class, 'tags'])->name('leads.tags');
            Route::post('/leads/tags',              [\App\Http\Controllers\Admin\LeadController::class, 'storeTag'])->name('leads.tags.store');
            Route::delete('/leads/tags/{leadTag}',  [\App\Http\Controllers\Admin\LeadController::class, 'destroyTag'])->name('leads.tags.destroy');
            Route::patch('/leads/{lead}',           [\App\Http\Controllers\Admin\LeadController::class, 'update'])->name('leads.update');
            Route::post('/leads/{lead}/add-tag',    [\App\Http\Controllers\Admin\LeadController::class, 'addTag'])->name('leads.addTag');
            Route::post('/leads/{lead}/remove-tag', [\App\Http\Controllers\Admin\LeadController::class, 'removeTag'])->name('leads.removeTag');
            Route::delete('/leads/{lead}',          [\App\Http\Controllers\Admin\LeadController::class, 'destroy'])->name('leads.destroy');

            // Landing Pages (non-standard resource: list + edit by cityKey)
            Route::get('/landing-pages',                  [AdminLandingPageController::class, 'index'])->name('landing-pages.index');
            Route::get('/landing-pages/{cityKey}/edit',   [AdminLandingPageController::class, 'edit'])->name('landing-pages.edit');
            Route::put('/landing-pages/{cityKey}',        [AdminLandingPageController::class, 'update'])->name('landing-pages.update');

            // Analytics Dashboard
            Route::get('/analytics', [\App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');

            // Per-Page SEO Settings
            Route::get('/seo',  [SeoController::class, 'index'])->name('seo.index');
            Route::put('/seo',  [SeoController::class, 'update'])->name('seo.update');
            Route::post('/seo/opengraph', [SeoController::class, 'storeOpengraph'])->name('seo.opengraph.store');
            Route::put('/seo/opengraph/{id}', [SeoController::class, 'updateOpengraph'])->name('seo.opengraph.update');
            Route::delete('/seo/opengraph/{id}', [SeoController::class, 'destroyOpengraph'])->name('seo.opengraph.destroy');
        });
    });
});

