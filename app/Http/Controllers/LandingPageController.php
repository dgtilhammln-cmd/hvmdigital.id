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
            foreach (["images/cities/{$city}.webp", "images/cities/{$city}.png"] as $tryPath) {
                if (file_exists(public_path($tryPath))) {
                    $ogImage = asset($tryPath);
                    break;
                }
            }
            $ogImage ??= asset('images/og-default.webp');
        }

        // Canonical: always production URL (SITE_URL env > DB setting > APP_URL fallback)
        $canonicalBase = env('SITE_URL') ?: setting('site_url', config('app.url'));
        $canonical     = rtrim($canonicalBase, '/') . '/' . ($cityConfig['slug'] ?? '');

        $seo = $this->seo->forCity($cityConfig, [
            'faqs'      => $schemaFaqs,
            'og_image'  => $ogImage,
            'canonical' => $canonical,
        ]);

        return view('pages.landing.city', compact(
            'seo', 'cityConfig', 'landing', 'faqs', 'testimonials', 'portfolios', 'city'
        ));
    }
}
