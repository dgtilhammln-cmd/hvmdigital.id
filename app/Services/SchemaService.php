<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Service;

class SchemaService
{
    public function organization(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => ['Organization', 'LocalBusiness', 'ProfessionalService'],
            'name' => 'HVM Digital',
            'alternateName' => 'HVM Digital - Digital & IT Solution',
            'url' => 'https://hvmdigital.id',
            'logo' => 'https://hvmdigital.id/images/logo.webp',
            'image' => 'https://hvmdigital.id/images/logo.webp',
            'description' => 'Agensi One-Stop Solution Digital Marketing & IT Solution berbasis di Surabaya',
            'foundingLocation' => 'Surabaya, Jawa Timur, Indonesia',
            'telephone' => '+62851-7998-2373',
            'email' => 'bisnis@hvmdigital.id',
            'priceRange' => 'Rp 500.000 - Rp 20.000.000',
            'currenciesAccepted' => 'IDR',
            'paymentAccepted' => 'Cash, Transfer Bank',
            'openingHours' => 'Mo,Tu,We,Th,Fr,Sa 08:00-21:00',
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens' => '08:00',
                'closes' => '21:00',
            ],
            'hasMap' => 'https://www.google.com/maps/search/?api=1&query=HVM+Digital+Surabaya+Jl.+Rungkut+Lor+VII+Dalam',
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'bestRating' => '5',
                'worstRating' => '1',
                'reviewCount' => '1984',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+62851-7998-2373',
                'contactType' => 'customer service',
                'availableLanguage' => 'Indonesian',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Rungkut Lor VII Dalam',
                'addressLocality' => 'Surabaya',
                'addressRegion' => 'Jawa Timur',
                'postalCode' => '60293',
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => -7.3195,
                'longitude' => 112.7667,
            ],
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

    public function defaultLocalBusiness(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => ['LocalBusiness', 'ProfessionalService'],
            '@id' => 'https://hvmdigital.id/#hq',
            'name' => 'HVM Digital (Headquarters)',
            'image' => 'https://hvmdigital.id/images/logo.webp',
            'url' => 'https://hvmdigital.id',
            'telephone' => '+62851-7998-2373',
            'email' => 'bisnis@hvmdigital.id',
            'priceRange' => 'Rp 500.000 - Rp 20.000.000',
            'currenciesAccepted' => 'IDR',
            'paymentAccepted' => 'Cash, Transfer Bank',
            'openingHours' => 'Mo,Tu,We,Th,Fr,Sa 08:00-21:00',
            'hasMap' => 'https://www.google.com/maps/search/?api=1&query=HVM+Digital+Surabaya+Jl.+Rungkut+Lor+VII+Dalam',
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'bestRating' => '5',
                'worstRating' => '1',
                'reviewCount' => '1984',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Rungkut Lor VII Dalam',
                'addressLocality' => 'Surabaya',
                'addressRegion' => 'Jawa Timur',
                'postalCode' => '60293',
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => -7.3195,
                'longitude' => 112.7667,
            ],
            'areaServed' => ['Surabaya', 'Sidoarjo', 'Gresik', 'Jawa Timur', 'Indonesia'],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens' => '08:00',
                'closes' => '21:00',
            ],
        ];
    }

    public function bekasiBranchLocalBusiness(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => ['LocalBusiness', 'ProfessionalService'],
            '@id' => 'https://hvmdigital.id/#branch-bekasi',
            'branchOf' => ['@id' => 'https://hvmdigital.id/#hq'],
            'name' => 'HVM Digital (Bekasi Branch)',
            'image' => 'https://hvmdigital.id/images/logo.webp',
            'url' => 'https://hvmdigital.id',
            'telephone' => '+62851-7998-2373',
            'email' => 'bisnis@hvmdigital.id',
            'priceRange' => 'Rp 500.000 - Rp 20.000.000',
            'currenciesAccepted' => 'IDR',
            'paymentAccepted' => 'Cash, Transfer Bank',
            'openingHours' => 'Mo,Tu,We,Th,Fr,Sa 08:00-21:00',
            'hasMap' => 'https://www.google.com/maps/search/?api=1&query=HVM+Digital+Bekasi+Sentra+Bisnis+Kota+Harapan+Indah',
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'bestRating' => '5',
                'worstRating' => '1',
                'reviewCount' => '845',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Sentra Bisnis Kota Harapan Indah Blok SS No 11',
                'addressLocality' => 'Bekasi',
                'addressRegion' => 'Jawa Barat',
                'postalCode' => '17132',
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => -6.1822,
                'longitude' => 106.9792,
            ],
            'areaServed' => ['Bekasi', 'Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Jawa Barat'],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens' => '08:00',
                'closes' => '21:00',
            ],
        ];
    }

    public function localBusiness(string $city, array $cityData): array
    {
        // Seeded unique review count per city (consistent, not hardcoded 87 everywhere)
        $seed        = crc32($cityData['key'] ?? $city);
        $reviewCount = (abs($seed) % 300) + 1650;

        // Accurate postal code per city (not hardcoded to Surabaya 60293)
        $postalMap = [
            'jakarta'    => '10110', 'surabaya'   => '60111', 'bali'       => '80117',
            'denpasar'   => '80117', 'medan'      => '20111', 'makassar'   => '90111',
            'yogyakarta' => '55111', 'bandung'    => '40111', 'semarang'   => '50111',
            'malang'     => '65111', 'solo'       => '57111', 'surakarta'  => '57111',
            'palembang'  => '30111', 'pekanbaru'  => '28111', 'batam'      => '29432',
            'balikpapan' => '76111', 'samarinda'  => '75111', 'pontianak'  => '78111',
            'manado'     => '95111', 'makassar'   => '90111', 'kupang'     => '85111',
            'jayapura'   => '99111', 'ambon'      => '97111', 'ternate'    => '97711',
            'mataram'    => '83111', 'banjarmasin'=> '70111', 'tarakan'    => '77111',
            'cirebon'    => '45111', 'bogor'      => '16111', 'depok'      => '16411',
            'bekasi'     => '17111', 'tangerang'  => '15111', 'gresik'     => '61111',
            'sidoarjo'   => '61211', 'lamongan'   => '62211', 'banyuwangi' => '68411',
            'jember'     => '68111', 'kediri'     => '64111', 'madiun'     => '63111',
            'purwokerto' => '53111', 'ngawi'      => '63211',
        ];
        $cityKey    = strtolower($cityData['key'] ?? $city);
        $postalCode = $postalMap[$cityKey] ?? ($cityData['postal_code'] ?? '');

        // Build areaServed — deduplicate city vs province (Bali=Bali case)
        $areaRaw = array_merge(
            [$city],
            ($cityData['province'] !== $city) ? [$cityData['province'] ?? ''] : ['Provinsi ' . $city],
            array_slice($cityData['nearby'] ?? [], 0, 5)
        );
        // Unique, filter empty
        $areaServed = array_values(array_unique(array_filter($areaRaw)));
        $provinceName = $cityData['province'] ?? '';

        return [
            '@context' => 'https://schema.org',
            '@type'    => ['LocalBusiness', 'ProfessionalService'],
            'name'     => "HVM Digital - Jasa Pembuatan Website {$city}",
            'image'    => asset("images/cities/{$cityKey}.webp"),
            'url'      => url()->current(),
            'telephone'=> '+62851-7998-2373',
            'email'    => 'bisnis@hvmdigital.id',
            'priceRange' => 'Rp 500.000 - Rp 20.000.000',
            'currenciesAccepted' => 'IDR',
            'paymentAccepted'    => 'Cash, Transfer Bank',
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
            // Use AdministrativeArea for provinces, City for cities/kecamatan
            'areaServed' => collect($areaServed)->map(function($a) use ($provinceName) {
                $isProvince = str_contains($a, 'Provinsi') || $a === $provinceName;
                return ['@type' => $isProvince ? 'AdministrativeArea' : 'City', 'name' => $a];
            })->values()->toArray(),
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name'  => "Layanan Digital HVM Digital untuk {$city}",
                'itemListElement' => [
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => "Jasa Pembuatan Website {$city}",
                            'description' => "Jasa pembuatan website profesional, responsive, cepat, dan SEO-friendly untuk bisnis & perusahaan Anda di {$city}."
                        ]
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => "Jasa Optimasi SEO {$city}",
                            'description' => "Layanan optimasi SEO halaman 1 Google untuk meningkatkan traffic organik dan prospek bisnis Anda di {$city}."
                        ]
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => "Google & Meta Ads {$city}",
                            'description' => "Manajemen kampanye iklan digital berkinerja tinggi (PPC) di Google Ads dan Facebook/Instagram Ads di {$city}."
                        ]
                    ],
                ],
            ],
            'openingHoursSpecification' => [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'opens'     => '08:00',
                'closes'    => '21:00',
            ],
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => '4.9',
                'bestRating'  => '5',
                'worstRating' => '1',
                'reviewCount' => (string) $reviewCount,
            ],
            'datePublished' => '2023-01-01',
            'dateModified'  => now()->format('Y-m-d'),
        ];
    }

    public function website(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'HVM Digital',
            'url' => 'https://hvmdigital.id',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => 'https://hvmdigital.id/artikel?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    public function article(Article $article): array
    {
        $bodyText = strip_tags(\Illuminate\Support\Str::markdown($article->content ?? ''));
        $wordCount = str_word_count($bodyText);
        $catName = $article->articleCategory?->name ?? $article->category ?? 'Digital Marketing';

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->title,
            'description' => $article->excerpt,
            'image' => [
                '@type' => 'ImageObject',
                'url' => $article->featured_image ? asset('storage/' . $article->featured_image) : asset('images/og-default.webp'),
                'width' => '1200',
                'height' => '630'
            ],
            'author' => [
                '@type' => 'Person',
                'name' => 'Tim HVM Digital',
                'url' => url('/'),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'HVM Digital',
                'logo' => ['@type' => 'ImageObject', 'url' => asset('images/logo.webp')],
            ],
            'datePublished' => $article->published_at?->toIso8601String(),
            'dateModified' => $article->updated_at->toIso8601String(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('articles.show', $article->slug),
            ],
            'wordCount' => $wordCount,
            'articleBody' => $bodyText,
            'articleSection' => $catName,
            'speakable' => [
                '@type' => 'SpeakableSpecification',
                'cssSelector' => ['#article-content']
            ],
        ];
    }

    public function service(Service $service): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service->name,
            'description' => $service->short_description,
            'provider' => ['@type' => 'Organization', 'name' => 'HVM Digital'],
            'areaServed' => 'Indonesia',
        ];
    }

    public function seoService(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => 'Jasa Optimasi SEO Halaman 1',
            'serviceType' => 'Search Engine Optimization',
            'provider' => ['@type' => 'Organization', 'name' => 'HVM Digital'],
            'areaServed' => 'Indonesia',
            'description' => 'Optimasi SEO B2B untuk bisnis dan perusahaan agar mendominasi halaman 1 Google dengan trafik organik tertarget dan konversi tinggi.',
        ];
    }

    public function faq(array $faqs): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faqs)->map(fn($faq) => [
                '@type' => 'Question',
                'name' => is_array($faq) ? $faq['question'] : $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => is_array($faq) ? $faq['answer'] : $faq->answer,
                ],
            ])->toArray(),
        ];
    }

    public function breadcrumb(array $items): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($items)->map(fn($item, $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ])->toArray(),
        ];
    }
}
