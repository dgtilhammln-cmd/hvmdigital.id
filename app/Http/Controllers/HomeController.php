<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Portfolio;
use App\Models\Article;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function index(): View
    {
        $hero_slides  = \App\Models\HeroSlide::where('is_active', true)->orderBy('order')->get();
        $services     = Service::active()->take(6)->get();
        $testimonials = Testimonial::active()->take(6)->get();
        $portfolios   = Portfolio::active()->take(8)->get();
        $articles     = Article::published()->latest()->take(3)->get();

        $seo = $this->seo->forPage('home', [
            'title'       => setting('home_meta_title', 'Jasa Digital Marketing & Website Surabaya Terpercaya | HVM Digital'),
            'description' => setting('home_meta_description', 'HVM Digital adalah agensi One-Stop Solution Digital Marketing & IT Solution di Surabaya. Website, SEO, Iklan Digital, dan Aplikasi Custom untuk bisnis Anda.'),
            'keywords'    => setting('home_meta_keywords', 'digital marketing surabaya, jasa website surabaya, IT solution surabaya, agensi digital surabaya, HVM Digital'),
            'schemas'     => [
                $this->schema->website(),                               // WebSite + SearchAction
                $this->schema->organization(),                          // Organization (@id anchored, AggregateRating)
                $this->schema->defaultLocalBusiness($testimonials),     // HQ LocalBusiness + Reviews dari DB
                $this->schema->bekasiBranchLocalBusiness($testimonials),// Bekasi Branch
                $this->schema->websiteProduct('Surabaya'),              // Product: harga low/high, offerCount
                $this->schema->webPage(                                 // WebPage: @id, isPartOf, breadcrumb
                    url('/'),
                    setting('home_meta_title', 'HVM Digital — Digital Marketing & IT Solution'),
                    setting('home_meta_description', 'Agensi Digital Marketing & IT Solution terpercaya di Surabaya.'),
                    [['name' => 'Home', 'url' => url('/')]]
                ),
                $this->schema->breadcrumb([['name' => 'Home', 'url' => url('/')]]),
            ],
        ]);

        return view('pages.home', compact('seo', 'hero_slides', 'services', 'testimonials', 'portfolios', 'articles'));
    }
}
