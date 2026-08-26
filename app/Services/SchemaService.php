<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Service;
use App\Models\Testimonial;

/**
 * SchemaService — JSON-LD Structured Data Generator untuk HVM Digital.
 *
 * Arsitektur @id anchoring:
 *   - Organization  → @id: https://hvm-digital.id/#organization
 *   - WebSite       → @id: https://hvm-digital.id/#website
 *   - HQ            → @id: https://hvm-digital.id/#hq
 *   - Bekasi Branch → @id: https://hvm-digital.id/#branch-bekasi
 *
 * Semua schema saling terhubung via @id sehingga membentuk Knowledge Graph
 * yang kuat (mirip pola Jasterweb & situs authority tinggi).
 */
class SchemaService
{
    // ─── CONSTANTS ────────────────────────────────────────────────────────────

    private const BASE_URL  = 'https://hvm-digital.id';
    private const LOGO_URL  = 'https://hvm-digital.id/images/logo.webp';
    private const ORG_ID    = 'https://hvm-digital.id/#organization';
    private const SITE_ID   = 'https://hvm-digital.id/#website';
    private const HQ_ID     = 'https://hvm-digital.id/#hq';
    private const BEKASI_ID = 'https://hvm-digital.id/#branch-bekasi';

    // ─── PRIMITIVES ───────────────────────────────────────────────────────────

    /**
     * AggregateRating — digunakan di semua LocalBusiness/Organization schema.
     * Data dari config/hvm.php agar cukup ubah di satu tempat.
     * WAJIB: Ulasan harus tampil secara visual di halaman (syarat Google).
     */
    public function aggregateRating(): array
    {
        return [
            '@type'       => 'AggregateRating',
            'ratingValue' => config('hvm.rating_value', '4.9'),
            'reviewCount' => config('hvm.review_count', '87'),
            'bestRating'  => '5',
            'worstRating' => '1',
        ];
    }

    /**
     * Individual Reviews — diambil dari Testimonial model (DB).
     * Google mewajibkan review tampil secara visual di halaman.
     * Ambil max 5 review terbaik (rating 5 bintang) untuk kualitas sinyal.
     *
     * @param  \Illuminate\Support\Collection|null $testimonials  Jika null, query otomatis.
     */
    public function reviews($testimonials = null): array
    {
        try {
            $items = $testimonials
                ?? Testimonial::active()->where('rating', 5)->take(5)->get();

            return $items->map(fn($t) => [
                '@type'         => 'Review',
                'author'        => [
                    '@type' => 'Person',
                    'name'  => $t->name,
                ],
                'reviewRating'  => [
                    '@type'       => 'Rating',
                    'ratingValue' => (string) ($t->rating ?? 5),
                    'bestRating'  => '5',
                    'worstRating' => '1',
                ],
                'reviewBody'    => $t->content,
                'datePublished' => $t->created_at?->format('Y-m-d') ?? now()->format('Y-m-d'),
                'itemReviewed'  => [
                    '@type' => 'LocalBusiness',
                    '@id'   => self::HQ_ID,
                    'name'  => 'HVM Digital',
                ],
            ])->toArray();
        } catch (\Throwable) {
            return [];
        }
    }

    /**
     * Product schema untuk layanan pembuatan website.
     * Menampilkan range harga low/high + offerCount di SERP (seperti Jasterweb).
     */
    public function websiteProduct(string $city = 'Seluruh Indonesia'): array
    {
        return [
            '@context'      => 'https://schema.org',
            '@type'         => 'Product',
            'name'          => "Jasa Pembuatan Website Profesional {$city}",
            'description'   => "Jasa pembuatan website profesional, responsif, cepat, dan SEO-friendly untuk bisnis & perusahaan di {$city}. Harga terjangkau, support 1 tahun.",
            'brand'         => [
                '@type' => 'Brand',
                'name'  => 'HVM Digital',
                '@id'   => self::ORG_ID,
            ],
            'image'         => self::LOGO_URL,
            'url'           => url()->current(),
            'aggregateRating' => $this->aggregateRating(),
            'offers'        => [
                '@type'         => 'AggregateOffer',
                'priceCurrency' => 'IDR',
                'lowPrice'      => config('hvm.price_low', '500000'),
                'highPrice'     => config('hvm.price_high', '50000000'),
                'offerCount'    => config('hvm.review_count', '127'),
                'availability'  => 'https://schema.org/InStock',
                'validFrom'     => '2026-01-01',
                'seller'        => [
                    '@type' => 'Organization',
                    '@id'   => self::ORG_ID,
                    'name'  => 'HVM Digital',
                ],
            ],
        ];
    }

    /**
     * WebPage schema dengan @id, isPartOf (→ WebSite), breadcrumb.
     * Menghubungkan halaman ke graph utama via @id anchoring.
     */
    public function webPage(string $url, string $name, string $description, array $breadcrumbItems = []): array
    {
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'WebPage',
            '@id'         => rtrim($url, '/') . '/#webpage',
            'url'         => $url,
            'name'        => $name,
            'description' => $description,
            'isPartOf'    => ['@id' => self::SITE_ID],
            'about'       => ['@id' => self::ORG_ID],
            'inLanguage'  => 'id-ID',
            'dateModified' => now()->toIso8601String(),
        ];

        if (!empty($breadcrumbItems)) {
            $schema['breadcrumb'] = $this->breadcrumb($breadcrumbItems);
        }

        return $schema;
    }

    // ─── ORGANIZATION & BUSINESS ──────────────────────────────────────────────

    /**
     * Organization schema — @id anchored, linked ke HQ.
     * Ditaruh di homepage & semua halaman utama.
     * CATATAN: Tidak menyebut tahun berdiri — cukup "berpengalaman".
     */
    public function organization(): array
    {
        return [
            '@context'      => 'https://schema.org',
            '@type'         => ['Organization', 'LocalBusiness', 'ProfessionalService'],
            '@id'           => self::ORG_ID,
            'name'          => 'HVM Digital',
            'alternateName' => 'HVM Digital - Digital & IT Solution',
            'url'           => self::BASE_URL,
            'logo'          => [
                '@type'  => 'ImageObject',
                '@id'    => self::BASE_URL . '/#logo',
                'url'    => self::LOGO_URL,
                'width'  => '200',
                'height' => '60',
            ],
            'image'       => self::LOGO_URL,
            'description' => 'Agensi Digital Marketing & IT Solution berpengalaman, spesialis pembuatan website profesional, SEO, Google Ads, dan aplikasi custom untuk bisnis di seluruh Indonesia.',
            'telephone'   => '+62851-7998-2373',
            'email'       => 'bisnis@hvm-digital.id',
            'priceRange'  => config('hvm.price_range', 'Rp 500.000 - Rp 50.000.000'),
            'currenciesAccepted' => 'IDR',
            'paymentAccepted'    => 'Cash, Transfer Bank',
            'openingHours'       => 'Mo,Tu,We,Th,Fr,Sa 08:00-21:00',
            'openingHoursSpecification' => [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens'     => '08:00',
                'closes'    => '21:00',
            ],
            'hasMap'      => 'https://www.google.com/maps/search/?api=1&query=HVM+Digital+Surabaya+Jl.+Rungkut+Lor+VII+Dalam',
            'contactPoint' => [
                '@type'             => 'ContactPoint',
                'telephone'         => '+62851-7998-2373',
                'contactType'       => 'customer service',
                'availableLanguage' => 'Indonesian',
                'areaServed'        => 'ID',
                'hoursAvailable'    => 'Mo,Tu,We,Th,Fr,Sa 08:00-21:00',
            ],
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Jl. Rungkut Lor VII Dalam',
                'addressLocality' => 'Surabaya',
                'addressRegion'   => 'Jawa Timur',
                'postalCode'      => '60293',
                'addressCountry'  => 'ID',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => -7.3195,
                'longitude' => 112.7667,
            ],
            'aggregateRating' => $this->aggregateRating(),
            'sameAs' => [
                'https://www.instagram.com/hvmdigital.id',
                'https://www.tiktok.com/@hvmdigital.id',
                'https://www.linkedin.com/company/hvm-digital-id',
            ],
            'knowsAbout' => [
                'Search Engine Optimization (SEO)',
                'Generative Engine Optimization (GEO)',
                'Web Development & Design',
                'Mobile App Development',
                'Social Media Marketing',
                'Google Ads (PPC)',
                'Meta Ads (Facebook & Instagram Ads)',
                'Custom Web Applications',
                'Enterprise IT Solutions',
                'Corporate Branding & Identity',
            ],
            'knowsLanguage' => ['id', 'en'],
        ];
    }

    /**
     * WebSite schema dengan SearchAction — @id anchored.
     * Memungkinkan Google menampilkan sitelinks searchbox.
     */
    public function website(): array
    {
        return [
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            '@id'             => self::SITE_ID,
            'name'            => 'HVM Digital',
            'alternateName'   => 'HVM Digital - Digital & IT Solution',
            'url'             => self::BASE_URL,
            'description'     => 'Agensi Digital Marketing & IT Solution terpercaya di Indonesia.',
            'inLanguage'      => 'id-ID',
            'publisher'       => ['@id' => self::ORG_ID],
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => [
                    '@type'       => 'EntryPoint',
                    'urlTemplate' => self::BASE_URL . '/artikel?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * HQ LocalBusiness — @id anchored, dengan reviews dari DB.
     */
    public function defaultLocalBusiness($testimonials = null): array
    {
        $schema = [
            '@context'       => 'https://schema.org',
            '@type'          => ['LocalBusiness', 'ProfessionalService'],
            '@id'            => self::HQ_ID,
            'parentOrganization' => ['@id' => self::ORG_ID],
            'name'           => 'HVM Digital',
            'image'          => self::LOGO_URL,
            'url'            => self::BASE_URL,
            'telephone'      => '+62851-7998-2373',
            'email'          => 'bisnis@hvm-digital.id',
            'priceRange'     => config('hvm.price_range', 'Rp 500.000 - Rp 50.000.000'),
            'currenciesAccepted' => 'IDR',
            'paymentAccepted'    => 'Cash, Transfer Bank',
            'openingHours'   => 'Mo,Tu,We,Th,Fr,Sa 08:00-21:00',
            'hasMap'         => 'https://www.google.com/maps/search/?api=1&query=HVM+Digital+Surabaya+Jl.+Rungkut+Lor+VII+Dalam',
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Jl. Rungkut Lor VII Dalam',
                'addressLocality' => 'Surabaya',
                'addressRegion'   => 'Jawa Timur',
                'postalCode'      => '60293',
                'addressCountry'  => 'ID',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => -7.3195,
                'longitude' => 112.7667,
            ],
            'aggregateRating' => $this->aggregateRating(),
            'areaServed'     => ['Surabaya', 'Sidoarjo', 'Gresik', 'Jawa Timur', 'Indonesia'],
            'openingHoursSpecification' => [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens'     => '08:00',
                'closes'    => '21:00',
            ],
        ];

        // Tambahkan individual reviews jika ada data
        $reviewList = $this->reviews($testimonials);
        if (!empty($reviewList)) {
            $schema['review'] = $reviewList;
        }

        return $schema;
    }

    /**
     * Bekasi Branch LocalBusiness — branchOf HQ, @id anchored.
     */
    public function bekasiBranchLocalBusiness($testimonials = null): array
    {
        $schema = [
            '@context'   => 'https://schema.org',
            '@type'      => ['LocalBusiness', 'ProfessionalService'],
            '@id'        => self::BEKASI_ID,
            'branchOf'   => ['@id' => self::HQ_ID],
            'name'       => 'HVM Digital - Bekasi',
            'image'      => self::LOGO_URL,
            'url'        => self::BASE_URL,
            'telephone'  => '+62851-7998-2373',
            'email'      => 'bisnis@hvm-digital.id',
            'priceRange' => config('hvm.price_range', 'Rp 500.000 - Rp 50.000.000'),
            'currenciesAccepted' => 'IDR',
            'paymentAccepted'    => 'Cash, Transfer Bank',
            'openingHours'       => 'Mo,Tu,We,Th,Fr,Sa 08:00-21:00',
            'hasMap'     => 'https://www.google.com/maps/search/?api=1&query=HVM+Digital+Bekasi+Sentra+Bisnis+Kota+Harapan+Indah',
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Sentra Bisnis Kota Harapan Indah Blok SS No 11',
                'addressLocality' => 'Bekasi',
                'addressRegion'   => 'Jawa Barat',
                'postalCode'      => '17132',
                'addressCountry'  => 'ID',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => -6.1822,
                'longitude' => 106.9792,
            ],
            'aggregateRating' => $this->aggregateRating(),
            'areaServed'      => ['Bekasi', 'Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Jawa Barat'],
            'openingHoursSpecification' => [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens'     => '08:00',
                'closes'    => '21:00',
            ],
        ];

        $reviewList = $this->reviews($testimonials);
        if (!empty($reviewList)) {
            $schema['review'] = $reviewList;
        }

        return $schema;
    }

    /**
     * City-specific LocalBusiness — unik per kota, @id anchored, branchOf HQ.
     *
     * Keunikan per kota diambil dari config/city-profiles.php:
     *   - description  → tagline + industri dominan kota
     *   - name         → nama HVM Digital spesifik kota + tagline singkat
     *   - knowsAbout   → industri utama kota tersebut
     *   - slogan       → kalimat value proposition spesifik kota
     *
     * CATATAN: Tidak menyebut tahun berdiri.
     *   Deskripsi cukup "berpengalaman menangani bisnis" tanpa klaim tahun.
     */
    public function localBusiness(string $city, array $cityData, $testimonials = null): array
    {
        // ── Postal code per kota ──────────────────────────────────────────────
        $postalMap = [
            'jakarta'     => '10110', 'surabaya'    => '60111', 'bali'        => '80117',
            'denpasar'    => '80117', 'medan'       => '20111', 'makassar'    => '90111',
            'yogyakarta'  => '55111', 'bandung'     => '40111', 'semarang'    => '50111',
            'malang'      => '65111', 'solo'        => '57111', 'surakarta'   => '57111',
            'palembang'   => '30111', 'pekanbaru'   => '28111', 'batam'       => '29432',
            'balikpapan'  => '76111', 'samarinda'   => '75111', 'pontianak'   => '78111',
            'manado'      => '95111', 'kupang'      => '85111', 'jayapura'    => '99111',
            'mataram'     => '83111', 'banjarmasin' => '70111', 'cirebon'     => '45111',
            'bogor'       => '16111', 'depok'       => '16411', 'bekasi'      => '17111',
            'tangerang'   => '15111', 'gresik'      => '61111', 'sidoarjo'    => '61211',
            'lamongan'    => '62211', 'banyuwangi'  => '68411', 'jember'      => '68111',
            'kediri'      => '64111', 'madiun'      => '63111', 'purwokerto'  => '53111',
            'ngawi'       => '63211',
        ];

        $cityKey      = strtolower($cityData['key'] ?? $city);
        $postalCode   = $postalMap[$cityKey] ?? ($cityData['postal_code'] ?? '');
        $provinceName = $cityData['province'] ?? '';
        $cityId       = self::BASE_URL . "/#lb-{$cityKey}";

        // ── Data unik dari city-profiles ──────────────────────────────────────
        $profile    = config("city-profiles.{$cityKey}", []);
        $tagline    = $profile['tagline']   ?? "Kota bisnis potensial di {$provinceName}";
        $industries = $profile['industries'] ?? ['Bisnis & UMKM', 'Digital Marketing', 'E-Commerce'];

        // Deskripsi unik: tagline + value proposition spesifik kota
        // Tidak menyebut tahun — cukup "berpengalaman"
        $industryList = implode(', ', array_slice($industries, 0, 3));
        $description  = "HVM Digital — jasa pembuatan website & digital marketing berpengalaman untuk bisnis di {$city}. "
            . "Spesialis melayani sektor {$industryList} di {$city} dan sekitarnya. "
            . "{$tagline}.";

        // Slogan unik per kota untuk signal differensiasi
        $slogan = "Website profesional & digital marketing terpercaya untuk bisnis {$city} — {$tagline}";

        // ── areaServed ────────────────────────────────────────────────────────
        $areaRaw    = array_merge(
            [$city],
            ($provinceName !== $city) ? [$provinceName] : ['Provinsi ' . $city],
            array_slice($cityData['nearby'] ?? [], 0, 5)
        );
        $areaServed = array_values(array_unique(array_filter($areaRaw)));

        // ── Offers unik: 3 layanan dengan konteks kota & industri ─────────────
        $primaryIndustry = $industries[0] ?? 'bisnis lokal';
        $offers = [
            [
                '@type'       => 'Offer',
                'itemOffered' => [
                    '@type'       => 'Service',
                    'name'        => "Jasa Pembuatan Website {$city}",
                    'description' => "Website profesional responsif & SEO-friendly untuk bisnis {$primaryIndustry} dan UMKM di {$city}.",
                ],
            ],
            [
                '@type'       => 'Offer',
                'itemOffered' => [
                    '@type'       => 'Service',
                    'name'        => "Jasa SEO {$city}",
                    'description' => "Optimasi halaman 1 Google untuk keyword bisnis {$city} — targetkan pelanggan lokal secara organik.",
                ],
            ],
            [
                '@type'       => 'Offer',
                'itemOffered' => [
                    '@type'       => 'Service',
                    'name'        => "Google & Meta Ads {$city}",
                    'description' => "Kampanye iklan digital PPC yang ditargetkan untuk menjangkau calon pelanggan di wilayah {$city} dan {$provinceName}.",
                ],
            ],
        ];

        $schema = [
            '@context'       => 'https://schema.org',
            '@type'          => ['LocalBusiness', 'ProfessionalService'],
            '@id'            => $cityId,
            'branchOf'       => ['@id' => self::HQ_ID],
            'name'           => "HVM Digital — Jasa Website & Digital Marketing {$city}",
            'description'    => $description,
            'slogan'         => $slogan,
            'image'          => asset("images/cities/{$cityKey}.webp"),
            'url'            => url()->current(),
            'telephone'      => '+62851-7998-2373',
            'email'          => 'bisnis@hvm-digital.id',
            'priceRange'     => config('hvm.price_range', 'Rp 500.000 - Rp 50.000.000'),
            'currenciesAccepted' => 'IDR',
            'paymentAccepted'    => 'Cash, Transfer Bank',
            'aggregateRating'    => $this->aggregateRating(),
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Jl. Rungkut Lor VII Dalam',
                'addressLocality' => $city,
                'addressRegion'   => $provinceName,
                'postalCode'      => $postalCode,
                'addressCountry'  => 'ID',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => $cityData['lat'] ?? 0,
                'longitude' => $cityData['lng'] ?? 0,
            ],
            'areaServed' => collect($areaServed)->map(function ($a) use ($provinceName) {
                $isProvince = str_contains($a, 'Provinsi') || $a === $provinceName;
                return ['@type' => $isProvince ? 'AdministrativeArea' : 'City', 'name' => $a];
            })->values()->toArray(),
            'knowsAbout'      => $industries, // unik per kota dari city-profiles
            'hasOfferCatalog' => [
                '@type'           => 'OfferCatalog',
                'name'            => "Layanan Website & Digital Marketing untuk {$city}",
                'itemListElement' => $offers,
            ],
            'openingHoursSpecification' => [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens'     => '08:00',
                'closes'    => '21:00',
            ],
        ];

        // Tambahkan individual reviews jika ada
        $reviewList = $this->reviews($testimonials);
        if (!empty($reviewList)) {
            $schema['review'] = $reviewList;
        }

        return $schema;
    }

    // ─── SERVICE / PRODUCT ────────────────────────────────────────────────────

    /**
     * Service schema — diperkuat dengan provider @id, areaServed, dan offers.
     */
    public function service(Service $service): array
    {
        return [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            '@id'         => url('/layanan/' . $service->slug) . '/#service',
            'name'        => $service->name,
            'description' => $service->short_description,
            'serviceType' => $service->name,
            'provider'    => ['@id' => self::ORG_ID],
            'areaServed'  => ['@type' => 'Country', 'name' => 'Indonesia'],
            'offers'      => [
                '@type'         => 'Offer',
                'priceCurrency' => 'IDR',
                'price'         => '500000',
                'availability'  => 'https://schema.org/InStock',
                'seller'        => ['@id' => self::ORG_ID],
            ],
            'aggregateRating' => $this->aggregateRating(),
        ];
    }

    /**
     * SEO Service schema khusus — lebih detail.
     */
    public function seoService(): array
    {
        return [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            '@id'         => self::BASE_URL . '/layanan/search-engine-optimization-seo/#service',
            'name'        => 'Jasa Optimasi SEO Halaman 1',
            'serviceType' => 'Search Engine Optimization',
            'provider'    => ['@id' => self::ORG_ID],
            'areaServed'  => ['@type' => 'Country', 'name' => 'Indonesia'],
            'description' => 'Optimasi SEO B2B untuk bisnis dan perusahaan agar mendominasi halaman 1 Google dengan trafik organik tertarget dan konversi tinggi.',
            'aggregateRating' => $this->aggregateRating(),
        ];
    }

    // ─── ARTICLE ──────────────────────────────────────────────────────────────

    /**
     * Article schema — @id linked, publisher → ORG_ID, isPartOf → SITE_ID.
     * Diperkuat dengan thumbnailUrl, inLanguage, speakable.
     */
    public function article(Article $article): array
    {
        $bodyText  = strip_tags(\Illuminate\Support\Str::markdown($article->content ?? ''));
        $wordCount = str_word_count($bodyText);
        $catName   = $article->articleCategory?->name ?? $article->category ?? 'Digital Marketing';
        $articleUrl = route('articles.show', $article->slug);

        $imagePath = $article->og_image ?: $article->featured_image;
        $imageUrl  = $imagePath
            ? (str_starts_with($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath))
            : asset('images/logohvm.png');

        return [
            '@context'         => 'https://schema.org',
            '@type'            => 'Article',
            '@id'              => $articleUrl . '/#article',
            'isPartOf'         => ['@id' => self::SITE_ID],
            'headline'         => $article->title,
            'description'      => $article->excerpt,
            'inLanguage'       => 'id-ID',
            'image'            => [
                '@type'  => 'ImageObject',
                '@id'    => $articleUrl . '/#image',
                'url'    => $imageUrl,
                'width'  => '1200',
                'height' => '630',
            ],
            'thumbnailUrl'     => $imageUrl,
            'author' => [
                '@type'    => 'Person',
                '@id'      => self::BASE_URL . '/#author-ilham',
                'name'     => 'Ilham Maulana',
                'url'      => url('/about'),
                'jobTitle' => 'CEO & SEO Specialist',
                'worksFor' => ['@id' => self::ORG_ID],
                'sameAs'   => [
                    'https://www.linkedin.com/in/ilham-maulana',
                    'https://www.instagram.com/hvmdigital.id',
                ],
            ],
            'publisher' => [
                '@type' => 'Organization',
                '@id'   => self::ORG_ID,
                'name'  => 'HVM Digital',
                'logo'  => [
                    '@type'  => 'ImageObject',
                    'url'    => self::LOGO_URL,
                    'width'  => '200',
                    'height' => '60',
                ],
            ],
            'datePublished'    => $article->published_at?->toIso8601String(),
            'dateModified'     => $article->updated_at->toIso8601String(),
            'wordCount'        => $wordCount,
            'articleBody'      => mb_substr($bodyText, 0, 3000), // limit agar tidak bloat
            'articleSection'   => $catName,
            'mainEntityOfPage' => ['@id' => $articleUrl . '/#webpage'],
            'speakable'        => [
                '@type'       => 'SpeakableSpecification',
                'cssSelector' => ['h1', '#article-content'],
            ],
        ];
    }

    // ─── HELPERS ──────────────────────────────────────────────────────────────

    /**
     * FAQPage schema.
     */
    public function faq(array $faqs): array
    {
        return [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => collect($faqs)->map(fn($faq) => [
                '@type'          => 'Question',
                'name'           => is_array($faq) ? $faq['question'] : $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => is_array($faq) ? $faq['answer'] : $faq->answer,
                ],
            ])->toArray(),
        ];
    }

    /**
     * BreadcrumbList schema.
     */
    public function breadcrumb(array $items): array
    {
        return [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => collect($items)->map(fn($item, $i) => [
                '@type'  => 'ListItem',
                'position' => $i + 1,
                'name'   => $item['name'],
                'item'   => $item['url'],
            ])->toArray(),
        ];
    }
}
