<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\View\View;

class InternshipController extends Controller
{
    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function index(): View
    {
        $internships = Internship::active()->get();

        // SEO schemas
        $jobPostings = $internships->map(function ($intern) {
            return [
                '@context' => 'https://schema.org/',
                '@type' => 'JobPosting',
                'title' => $intern->title,
                'description' => $intern->qualifications . ' ' . $intern->jobdesc,
                'datePosted' => $intern->created_at->toIso8601String(),
                'validThrough' => $intern->created_at->addMonths(6)->toIso8601String(),
                'employmentType' => 'INTERN',
                'baseSalary' => [
                    '@type' => 'MonetaryAmount',
                    'currency' => 'IDR',
                    'value' => [
                        '@type' => 'QuantitativeValue',
                        'value' => 1500000,
                        'unitText' => 'MONTH'
                    ]
                ],
                'hiringOrganization' => [
                    '@type' => 'Organization',
                    'name' => 'HVM Digital',
                    'sameAs' => 'https://hvm-digital.id',
                    'logo' => 'https://hvm-digital.id/images/logo.webp'
                ],
                'jobLocation' => [
                    '@type' => 'Place',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Jl. Rungkut Lor VII Dalam',
                        'addressLocality' => 'Surabaya',
                        'addressRegion' => 'Jawa Timur',
                        'postalCode' => '60293',
                        'addressCountry' => 'ID'
                    ]
                ]
            ];
        })->toArray();

        $schemas = [
            $this->schema->organization(),
            $this->schema->breadcrumb([
                ['name' => 'Home', 'url' => url('/')],
                ['name' => 'Internship', 'url' => url('/internship')],
            ]),
        ];

        // Merge JobPosting schemas
        $schemas = array_merge($schemas, $jobPostings);

        $seo = $this->seo->generate([
            'title'       => 'Program Internship & Karir | HVM Digital',
            'description' => 'Mulai karir digital Anda bersama HVM Digital. Kami membuka lowongan internship untuk berbagai posisi seperti Web Development, UI/UX, dan Digital Marketing.',
            'schemas'     => $schemas,
        ]);

        return view('pages.internships.index', compact('internships', 'seo'));
    }
}
