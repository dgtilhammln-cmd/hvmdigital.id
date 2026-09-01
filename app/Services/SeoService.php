<?php

namespace App\Services;

class SeoService
{
    public function __construct(private SchemaService $schema) {}

    public function getCurrentPageKey(): ?string
    {
        try {
            $route = request()->route();
            if (!$route) {
                return null;
            }
            $routeName = $route->getName();
            if (!$routeName) {
                return null;
            }

            // Map route names to keys used in mappings
            if ($routeName === 'home') return 'home';
            if ($routeName === 'about') return 'about';
            if ($routeName === 'services') return 'services';
            if ($routeName === 'portfolio') return 'portfolio';
            if ($routeName === 'articles') return 'articles';
            if ($routeName === 'contact') return 'contact';
            if ($routeName === 'internship.index') return 'internship';
            if ($routeName === 'career.index') return 'career';
            if ($routeName === 'services.seo') return 'services.seo';

            // City landing pages: city.{cityKey}
            if (str_starts_with($routeName, 'city.')) {
                return $routeName;
            }

            // Service details: services.show
            if ($routeName === 'services.show') {
                $service = $route->parameter('service');
                if ($service instanceof \App\Models\Service) {
                    return "service.{$service->slug}";
                }
                if (is_string($service)) {
                    return "service.{$service}";
                }
            }

            // Article details: articles.show
            if ($routeName === 'articles.show') {
                $article = $route->parameter('article');
                if ($article instanceof \App\Models\Article) {
                    return "article.{$article->slug}";
                }
                if (is_string($article)) {
                    return "article.{$article}";
                }
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return null;
    }

    public function getCustomOgImage(): ?string
    {
        try {
            $key = $this->getCurrentPageKey();
            if (!$key) {
                return null;
            }

            // Find the latest mapping for this key
            $mapping = \App\Models\SeoOpengraph::where('pages', 'LIKE', '%"' . $key . '"%')->latest()->first();
            if ($mapping && $mapping->image_path) {
                return get_image_url($mapping->image_path);
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return null;
    }

    public function generate(array $data): array
    {
        $siteName = setting('site_name', config('hvm.name'));
        
        $customOgImage = $this->getCustomOgImage();
        $ogImage = $data['og_image'] ?? null;
        
        if ($customOgImage) {
            $ogImage = $customOgImage;
        }

        if (!$ogImage) {
            $ogImage = setting('og_image_default') 
                ? get_image_url(setting('og_image_default')) 
                : (setting('favicon') ? get_image_url(setting('favicon')) : (file_exists(public_path('favicon.png')) ? asset('favicon.png') : asset('images/logohvm.png')));
        }

        return [
            // Basic Meta
            'title'       => $data['title'] ?? $siteName,
            'description' => $data['description'] ?? setting('site_description', 'Agensi Digital Marketing & IT Solution Terpercaya di Indonesia. Dapatkan peningkatan trafik hingga 300% & konversi tinggi untuk bisnis Anda bersama HVM Digital.'),
            'keywords'    => $data['keywords'] ?? setting('site_keywords', 'digital marketing, jasa website, IT solution, Indonesia'),
            'canonical'   => $data['canonical'] ?? url()->current(),
            'robots'      => $data['robots'] ?? 'index, follow',
            'author'      => $siteName,
            'language'    => 'Indonesian',

            // Open Graph
            'og_title'       => $data['og_title'] ?? $data['title'] ?? $siteName,
            'og_description' => $data['og_description'] ?? $data['description'] ?? '',
            'og_image'       => $ogImage,
            'og_type'        => $data['og_type'] ?? 'website',
            'og_url'         => $data['og_url'] ?? url()->current(),
            'og_site_name'   => $siteName,
            'og_locale'      => 'id_ID',

            // Twitter Card
            'twitter_card'        => 'summary_large_image',
            'twitter_domain'      => parse_url(config('app.url'), PHP_URL_HOST) ?? 'hvm-digital.id',
            'twitter_title'       => $data['title'] ?? $siteName,
            'twitter_description' => $data['description'] ?? '',
            'twitter_image'       => $ogImage,

            // JSON-LD Schemas
            'schemas' => $data['schemas'] ?? [],

            // Geo Meta
            'geo_region'    => $data['geo_region']    ?? config('hvm.default_geo_region', 'ID'),
            'geo_placename' => $data['geo_placename'] ?? config('hvm.default_placename', 'Indonesia'),
            'geo_position'  => $data['geo_position']  ?? config('hvm.default_position', '-0.7893;113.9213'),
            'icbm'          => $data['icbm']          ?? config('hvm.default_icbm', '-0.7893, 113.9213'),
        ];
    }


    /**
     * Build SEO for a city landing page.
     */
    public function forCity(array $cityConfig, array $landingData = []): array
    {
        $schemas = [
            $this->schema->website(),
            $this->schema->organization(),
            $this->schema->localBusiness($cityConfig['name'], $cityConfig, $landingData['testimonials'] ?? null),
            $this->schema->breadcrumb([
                ['name' => 'Home',    'url' => url('/')],
                ['name' => 'Layanan', 'url' => route('services')],
                ['name' => 'Jasa Website ' . $cityConfig['name'], 'url' => $landingData['canonical'] ?? url()->current()],
            ]),
        ];

        if (!empty($landingData['faqs'])) {
            $schemas[] = $this->schema->faq($landingData['faqs']);
        }

        // Merge extra schemas dari controller (Product, WebPage, dll)
        if (!empty($landingData['extra_schemas'])) {
            $schemas = array_merge($schemas, $landingData['extra_schemas']);
        }

        // Hanya Surabaya & Lamongan yang di-index oleh Google
        $indexedCities = ['surabaya', 'lamongan'];
        $cityKey = $cityConfig['key'] ?? '';
        $robots = in_array($cityKey, $indexedCities)
            ? 'index, follow, max-image-preview:large, max-snippet:-1'
            : 'noindex, follow';

        return $this->generate([
            'title'         => $cityConfig['title'],
            'description'   => $cityConfig['description'],
            'keywords'      => $cityConfig['keywords'] ?? '',
            // Forward controller-set canonical & og_image (prevents localhost canonical)
            'canonical'     => $landingData['canonical'] ?? null,
            'og_image'      => $landingData['og_image'] ?? null,
            'og_url'        => $landingData['canonical'] ?? url()->current(),
            'geo_region'    => $cityConfig['geo_region'],
            'geo_placename' => $cityConfig['name'],
            'geo_position'  => ($cityConfig['lat'] ?? 0) . ';' . ($cityConfig['lng'] ?? 0),
            'icbm'          => ($cityConfig['lat'] ?? 0) . ', ' . ($cityConfig['lng'] ?? 0),
            'schemas'       => $schemas,
            'robots'        => $robots,
        ]);
    }

    /**
     * Build SEO for an article page.
     */
    public function forArticle(\App\Models\Article $article): array
    {
        $schemas = [
            $this->schema->organization(),
            $this->schema->defaultLocalBusiness(),
            $this->schema->article($article),
            $this->schema->breadcrumb([
                ['name' => 'Home', 'url' => url('/')],
                ['name' => 'Artikel', 'url' => route('articles')],
                ['name' => $article->title, 'url' => url()->current()],
            ]),
        ];

        if ($article->faqs && is_array($article->faqs) && count($article->faqs) > 0) {
            $schemas[] = $this->schema->faq($article->faqs);
        }

        // Use og_image if specified, otherwise fallback to featured_image, else default.
        // Must be absolute URL — WhatsApp/Facebook require full URL for og:image.
        $imagePath = $article->og_image ?: $article->featured_image;
        if ($imagePath) {
            $rawUrl = get_image_url($imagePath);
            $ogImage = str_starts_with($rawUrl, 'http') ? $rawUrl : url($rawUrl);
        } else {
            $ogImage = url(asset('images/logohvm.png'));
        }

        return $this->generate([
            'title'       => $article->meta_title ?: $article->title,
            'description' => $article->meta_description ?: $article->excerpt,
            'keywords'    => $article->meta_keywords,
            'og_type'     => 'article',
            'og_image'    => $ogImage,
            'robots'      => 'index, follow, max-image-preview:large, max-snippet:-1',
            'schemas'     => $schemas,

            // Sinyal waktu publikasi & update — penting untuk freshness ranking
            'article_published_time' => $article->published_at?->toAtomString(),
            'article_modified_time'  => $article->updated_at?->toAtomString(),
            'og_updated_time'        => $article->updated_at?->toAtomString(),
        ]);
    }

    /**
     * Build SEO for any static page using admin-managed settings.
     * Admin keys: {pageKey}_meta_title, {pageKey}_meta_description, {pageKey}_meta_keywords
     * Example: home_meta_title, about_meta_description, services_meta_keywords
     */
    public function forPage(string $pageKey, array $override = []): array
    {
        $siteName    = setting('site_name', 'HVM Digital');
        $title       = setting("{$pageKey}_meta_title", $override['title'] ?? $siteName);
        $description = setting("{$pageKey}_meta_description", $override['description'] ?? setting('site_description', ''));
        $keywords    = setting("{$pageKey}_meta_keywords", $override['keywords'] ?? setting('site_keywords', ''));

        $ogImageSetting = setting("{$pageKey}_og_image");
        $ogImage = $ogImageSetting ? get_image_url($ogImageSetting) : ($override['og_image'] ?? null);

        $baseSchemas = $override['schemas'] ?? [
            $this->schema->organization(),
            $this->schema->website(),
        ];

        // Retrieve and append page-specific FAQs if present
        $faqs = \App\Models\Faq::active()->where('category', "page:{$pageKey}")->get();
        if ($faqs->count() > 0) {
            $baseSchemas[] = $this->schema->faq($faqs->toArray());
        }

        return $this->generate(array_merge($override, [
            'title'       => $title,
            'description' => $description,
            'keywords'    => $keywords,
            'og_image'    => $ogImage,
            'schemas'     => $baseSchemas,
        ]));
    }
}
