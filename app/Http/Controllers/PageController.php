<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function about(): View
    {
        $testimonials = Testimonial::active()->take(4)->get();

        $seo = $this->seo->forPage('about', [
            'title'       => setting('about_meta_title', 'Tentang Kami — HVM Digital | Harbour Visionary Minds'),
            'description' => setting('about_meta_description', 'HVM Digital (Harbour Visionary Minds) adalah agensi digital marketing & IT solution berbasis di Surabaya. Kami hadir sebagai pelabuhan bagi ide-ide besar bisnis Anda.'),
            'keywords'    => setting('about_meta_keywords', 'tentang HVM Digital, harbour visionary minds, agensi digital Surabaya, profil perusahaan HVM'),
            'robots'      => 'noindex, nofollow',
            'schemas'     => [
                $this->schema->organization(),
                $this->schema->breadcrumb([
                    ['name' => 'Home', 'url' => url('/')],
                    ['name' => 'Tentang Kami', 'url' => route('about')],
                ]),
            ],
        ]);

        return view('pages.about', compact('seo', 'testimonials'));
    }

    public function contact(): View
    {
        $seo = $this->seo->forPage('contact', [
            'title'       => setting('contact_meta_title', 'Kontak HVM Digital — Hubungi Kami Sekarang'),
            'description' => setting('contact_meta_description', 'Hubungi HVM Digital untuk konsultasi gratis. WhatsApp: +62851-7998-2373. Email: bisnis@hvmdigital.id. Kantor Surabaya & Bekasi.'),
            'keywords'    => setting('contact_meta_keywords', 'kontak HVM Digital, hubungi HVM Digital, konsultasi website gratis, WhatsApp HVM Digital'),
            'schemas'     => [
                $this->schema->organization(),
                $this->schema->breadcrumb([
                    ['name' => 'Home', 'url' => url('/')],
                    ['name' => 'Kontak', 'url' => route('contact')],
                ]),
            ],
        ]);

        return view('pages.contact', compact('seo'));
    }
}
