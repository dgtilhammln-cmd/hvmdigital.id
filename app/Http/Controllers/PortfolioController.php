<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    // Cities grouped by region for filter
    const REGIONS = [
        'barat'  => ['Jakarta','Surabaya','Bandung','Semarang','Yogyakarta','Solo','Bekasi','Bogor',
                     'Depok','Tangerang','Cirebon','Medan','Palembang','Pekanbaru','Batam','Padang',
                     'Denpasar','Malang','Sidoarjo','Gresik','Lamongan','Kediri','Madiun','Jember',
                     'Banyuwangi','Ngawi','Purwokerto'],
        'tengah' => ['Samarinda','Balikpapan','Pontianak','Banjarmasin','Makassar','Manado'],
        'timur'  => ['Mataram','Kupang','Jayapura','Ambon','Ternate'],
    ];

    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function index(Request $request): View
    {
        $category = $request->query('kategori');
        $region   = $request->query('wilayah');   // barat | tengah | timur

        $query = Portfolio::active();

        if ($category) {
            $query->where('category', $category);
        }

        if ($region && isset(self::REGIONS[$region])) {
            $query->whereIn('city', self::REGIONS[$region]);
        }

        $portfolios = $query->paginate(12)->withQueryString();
        $categories = \DB::table('portfolios')->where('is_active', true)->whereNotNull('category')
                        ->groupBy('category')->pluck('category')->filter()->values();
        $cities     = \DB::table('portfolios')->where('is_active', true)->whereNotNull('city')
                        ->groupBy('city')->pluck('city')->filter()->values();

        $seo = $this->seo->forPage('portfolio', [
            'title'       => setting('portfolio_meta_title', 'Portfolio HVM Digital — Karya Nyata Klien Kami'),
            'description' => setting('portfolio_meta_description', 'Lihat portofolio website, landing page, dan aplikasi yang telah HVM Digital bangun untuk klien di seluruh Indonesia — dari firma hukum hingga perusahaan engineering.'),
            'keywords'    => setting('portfolio_meta_keywords', 'portfolio HVM Digital, contoh website profesional, jasa website Surabaya Jakarta, karya digital agency'),
            'schemas'     => [
                $this->schema->organization(),
                $this->schema->breadcrumb([
                    ['name' => 'Home',       'url' => url('/')],
                    ['name' => 'Portfolio',  'url' => route('portfolio')],
                ]),
            ],
        ]);

        return view('pages.portfolio', compact('seo', 'portfolios', 'categories', 'cities', 'category', 'region'));
    }
}
