<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\LandingPage;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SitemapController extends Controller
{
    /**
     * Force production URL agar sitemap selalu menggunakan domain produksi,
     * bukan localhost — ini kritis untuk Google Search Console.
     */
    private function prodUrl(string $path = ''): string
    {
        $base = rtrim(config('app.url'), '/');

        // Jika APP_URL masih localhost, override ke domain produksi
        if (str_contains($base, 'localhost') || str_contains($base, '127.0.0.1')) {
            $base = 'https://hvm-digital.id';
        }

        return $base . '/' . ltrim($path, '/');
    }

    public function index(): Response
    {
        $cities   = config('cities', []);
        $articles = Article::published()->latest()->get();
        $services = \App\Models\Service::active()->get();

        // Tanggal terakhir update konten statis (fallback: hari ini)
        $lastArticle  = Article::published()->latest('updated_at')->first();
        $lastService  = \App\Models\Service::active()->latest('updated_at')->first();
        $siteLastMod  = now()->startOfDay()->toAtomString();

        $urls = [
            [
                'loc'        => $this->prodUrl('/'),
                'lastmod'    => $lastArticle ? $lastArticle->updated_at->toAtomString() : $siteLastMod,
                'priority'   => '1.0',
                'changefreq' => 'weekly',
            ],
            [
                'loc'        => $this->prodUrl('/layanan'),
                'lastmod'    => $lastService ? $lastService->updated_at->toAtomString() : $siteLastMod,
                'priority'   => '0.9',
                'changefreq' => 'weekly',
            ],
            [
                'loc'        => $this->prodUrl('/layanan/jasa-optimasi-seo-halaman-1'),
                'lastmod'    => $siteLastMod,
                'priority'   => '0.95',
                'changefreq' => 'weekly',
            ],
            [
                'loc'        => $this->prodUrl('/portfolio'),
                'lastmod'    => $siteLastMod,
                'priority'   => '0.7',
                'changefreq' => 'weekly',
            ],
            [
                'loc'        => $this->prodUrl('/kontak'),
                'lastmod'    => $siteLastMod,
                'priority'   => '0.6',
                'changefreq' => 'monthly',
            ],
            [
                'loc'        => $this->prodUrl('/artikel'),
                'lastmod'    => $lastArticle ? $lastArticle->updated_at->toAtomString() : $siteLastMod,
                'priority'   => '0.8',
                'changefreq' => 'daily',
            ],
            [
                'loc'        => $this->prodUrl('/internship'),
                'lastmod'    => $siteLastMod,
                'priority'   => '0.7',
                'changefreq' => 'monthly',
            ],
            [
                'loc'        => $this->prodUrl('/karir'),
                'lastmod'    => $siteLastMod,
                'priority'   => '0.7',
                'changefreq' => 'monthly',
            ],
        ];

        // City landing pages — hanya Surabaya & Lamongan yang di-index
        $priorityCities = ['surabaya', 'lamongan'];
        foreach ($priorityCities as $cityKey) {
            $cityConfig = $cities[$cityKey] ?? null;
            if (!$cityConfig) continue;

            $lp = LandingPage::where('city_key', $cityKey)->first();
            $lastmod = $lp && $lp->updated_at ? $lp->updated_at->toAtomString() : $siteLastMod;

            $urls[] = [
                'loc'        => $this->prodUrl('/' . $cityConfig['slug']),
                'lastmod'    => $lastmod,
                'priority'   => '0.95',
                'changefreq' => 'monthly',
            ];
        }

        // Dynamic Services
        foreach ($services as $service) {
            $urls[] = [
                'loc'        => $this->prodUrl('/layanan/' . $service->slug),
                'lastmod'    => $service->updated_at->toAtomString(),
                'priority'   => '0.85',
                'changefreq' => 'monthly',
            ];
        }

        // Articles
        foreach ($articles as $article) {
            $urls[] = [
                'loc'        => $this->prodUrl('/artikel/' . $article->slug),
                'lastmod'    => $article->updated_at->toAtomString(),
                'priority'   => '0.7',
                'changefreq' => 'monthly',
            ];
        }

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $sitemapUrl = $this->prodUrl('/sitemap.xml');

        $content = <<<ROBOTS
# ==========================================
# HVM DIGITAL - ROBOTS.TXT
# ==========================================

# ------------------------------------------
# 2. SEO TOOLS — DIIZINKAN CRAWL
# ------------------------------------------
User-agent: SemrushBot
Allow: /

User-agent: AhrefsBot
Allow: /

User-agent: PetalBot
Allow: /

# ------------------------------------------
# 3. GLOBAL DEFAULT RULE
# ------------------------------------------
User-agent: *
Allow: /
Disallow: /admin/
Disallow: /api/
Disallow: /*.sql$
Disallow: /*.env$

# ------------------------------------------
# 3. SITEMAP LOCATION
# ------------------------------------------
Sitemap: {$sitemapUrl}
ROBOTS;

        return response($content)->header('Content-Type', 'text/plain');
    }
}
