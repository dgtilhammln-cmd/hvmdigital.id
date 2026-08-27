<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function index(): View
    {
        $careers = Career::active()->get();

        // SEO schemas
        $jobPostings = $careers->map(function ($career) {
            return [
                '@context' => 'https://schema.org/',
                '@type' => 'JobPosting',
                'title' => $career->title,
                'description' => $career->qualifications . ' ' . $career->jobdesc,
                'datePosted' => $career->created_at->toIso8601String(),
                'validThrough' => $career->created_at->addMonths(6)->toIso8601String(),
                'employmentType' => 'FULL_TIME',
                'baseSalary' => [
                    '@type' => 'MonetaryAmount',
                    'currency' => 'IDR',
                    'value' => [
                        '@type' => 'QuantitativeValue',
                        'minValue' => 3500000,
                        'maxValue' => 6000000,
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
                ['name' => 'Karir', 'url' => url('/karir')],
            ]),
        ];

        // Merge JobPosting schemas
        $schemas = array_merge($schemas, $jobPostings);

        $seo = $this->seo->generate([
            'title'       => 'Karir & Lowongan Pekerjaan | HVM Digital',
            'description' => 'Mulai karir digital Anda bersama HVM Digital. Kami membuka lowongan pekerjaan untuk berbagai posisi seperti Web Development, UI/UX, dan Digital Marketing.',
            'schemas'     => $schemas,
        ]);

        return view('pages.careers.index', compact('careers', 'seo'));
    }
}
