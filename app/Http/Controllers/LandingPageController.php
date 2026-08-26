<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Portfolio;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function show(string $city): View
    {
        $cityConfig = config("cities.{$city}");
        if (!$cityConfig) abort(404);

        $landing = LandingPage::where('city_key', $city)->where('is_active', true)->first();

        // FAQ: DB city-specific + city profile fallback FAQs
        $faqs = Faq::active()
            ->where(fn($q) => $q->whereNull('city_key')->orWhere('city_key', $city))
            ->get();

        // Schema FAQs: profile-specific ALWAYS first (matches blade FAQ priority)
        $profileFaqs = config("city-profiles.{$city}.faqs", []);
        $schemaFaqs  = array_map(fn($pf) => ['question' => $pf['q'], 'answer' => $pf['a']], $profileFaqs);
        if (count($schemaFaqs) < 2) {
            // supplement with DB FAQs only if profile has too few
            foreach ($faqs->toArray() as $dbFaq) {
                $schemaFaqs[] = $dbFaq;
            }
        }

        $testimonials = Testimonial::active()
            ->where(fn($q) => $q->where('city_key', $city)->orWhereNull('city_key'))
            ->take(6)->get();

        $portfolios = Portfolio::active()->take(6)->get();

        // Per-city OG image — prefer DB og_image, then file-based, then default
        $ogImage = null;
        if ($landing && $landing->og_image) {
            $ogImage = get_image_url($landing->og_image);
        } else {
            // Try webp first (valid if > 1KB), then png, then defaults
            foreach (["images/cities/{$city}.webp", "images/cities/{$city}.png"] as $tryPath) {
                $fullPath = public_path($tryPath);
                if (file_exists($fullPath) && filesize($fullPath) > 1024) { // skip broken stubs (<1KB)
                    $ogImage = asset($tryPath);
                    break;
                }
            }
            // Fallback chain: og-default.webp → og-default.png → logohvm.png
            if (!$ogImage) {
                foreach (['images/og-default.webp', 'images/og-default.png', 'images/logohvm.png'] as $fallback) {
                    if (file_exists(public_path($fallback))) {
                        $ogImage = asset($fallback);
                        break;
                    }
                }
                $ogImage ??= asset('images/logohvm.png');
            }
        }

        // Canonical: always production URL (SITE_URL env > DB setting > APP_URL fallback)
        $canonicalBase = env('SITE_URL') ?: setting('site_url', config('app.url'));
        $canonical     = rtrim($canonicalBase, '/') . '/' . ($cityConfig['slug'] ?? '');

        // ── Extra schemas: Product (harga), WebPage (@id), Reviews ──────────
        $extraSchemas = [
            $this->schema->websiteProduct($cityConfig['name']),
            $this->schema->webPage(
                $canonical,
                $cityConfig['title'],
                $cityConfig['description'],
                [
                    ['name' => 'Home',    'url' => url('/')],
                    ['name' => 'Layanan', 'url' => route('services')],
                    ['name' => 'Jasa Website ' . $cityConfig['name'], 'url' => $canonical],
                ]
            ),
        ];

        $seo = $this->seo->forCity($cityConfig, [
            'faqs'         => $schemaFaqs,
            'og_image'     => $ogImage,
            'canonical'    => $canonical,
            'extra_schemas' => $extraSchemas,
        ]);

        return view('pages.landing.city', compact(
            'seo', 'cityConfig', 'landing', 'faqs', 'testimonials', 'portfolios', 'city'
        ));
    }
}
