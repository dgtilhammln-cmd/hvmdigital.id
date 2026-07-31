<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\LandingPage;
use App\Models\Service;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PageManagementController extends Controller
{
    private array $corePages = [
        'home' => [
            'name' => 'Home / Beranda Utama',
            'desc' => 'Halaman utama HVM Digital',
        ],
        'about' => [
            'name' => 'Tentang Kami',
            'desc' => 'Profil, visi, dan misi HVM Digital',
        ],
        'services' => [
            'name' => 'Layanan (Index)',
            'desc' => 'Daftar semua layanan digital marketing & IT',
        ],
        'services.seo' => [
            'name' => 'Jasa Optimasi SEO Halaman 1',
            'desc' => 'Halaman detail khusus layanan SEO & SEM',
        ],
        'portfolio' => [
            'name' => 'Portfolio',
            'desc' => 'Galeri karya nyata dan case study klien',
        ],
        'articles' => [
            'name' => 'Artikel / Blog (Index)',
            'desc' => 'Daftar publikasi artikel dan insight',
        ],
        'contact' => [
            'name' => 'Kontak',
            'desc' => 'Alamat, peta kantor, dan formulir hubungi kami',
        ],
    ];

    private array $defaultSEO = [
        'home' => [
            'meta_title' => 'Jasa Digital Marketing & Website Surabaya Terpercaya | HVM Digital',
            'meta_description' => 'HVM Digital adalah agensi One-Stop Solution Digital Marketing & IT Solution di Surabaya. Website, SEO, Iklan Digital, dan Aplikasi Custom untuk bisnis Anda.',
            'meta_keywords' => 'digital marketing surabaya, jasa website surabaya, IT solution surabaya, agensi digital surabaya, HVM Digital',
        ],
        'about' => [
            'meta_title' => 'Tentang Kami — HVM Digital | Harbour Visionary Minds',
            'meta_description' => 'HVM Digital (Harbour Visionary Minds) adalah agensi digital marketing & IT solution berbasis di Surabaya. Kami hadir sebagai pelabuhan bagi id-ide besar bisnis Anda.',
            'meta_keywords' => 'tentang HVM Digital, harbour visionary minds, agensi digital Surabaya, profil perusahaan HVM',
        ],
        'services' => [
            'meta_title' => 'Layanan HVM Digital — Digital Marketing & IT Solution',
            'meta_description' => 'Layanan lengkap HVM Digital: Pembuatan Website, SEO, Google Ads, Social Media Management, Aplikasi Custom, dan IT Solution untuk bisnis Anda di seluruh Indonesia.',
            'meta_keywords' => 'layanan digital marketing, jasa pembuatan website, SEO profesional, Google Ads, aplikasi custom, IT solution indonesia',
        ],
        'services.seo' => [
            'meta_title' => 'Jasa Optimasi SEO Halaman 1 | HVM Digital',
            'meta_description' => 'Jasa SEO Profesional terpercaya seluruh Indonesia — ratusan leads organik per bulan, laporan transparan, White-Hat SEO. Konsultasi gratis hari ini!',
            'meta_keywords' => 'jasa optimasi seo, seo halaman 1, jasa seo indonesia, jasa seo b2b, hvm digital',
        ],
        'portfolio' => [
            'meta_title' => 'Portfolio HVM Digital — Karya Nyata Klien Kami',
            'meta_description' => 'Lihat portofolio website, landing page, dan aplikasi yang telah HVM Digital bangun untuk klien di seluruh Indonesia — dari firma hukum hingga perusahaan engineering.',
            'meta_keywords' => 'portfolio HVM Digital, contoh website profesional, jasa website Surabaya Jakarta, karya digital agency',
        ],
        'articles' => [
            'meta_title' => 'Blog & Artikel Digital Marketing | HVM Digital',
            'meta_description' => 'Tips, strategi, dan insight digital marketing, pembuatan website, dan IT solution dari tim HVM Digital.',
            'meta_keywords' => 'blog digital marketing, artikel website, tips SEO, insight IT solution, HVM Digital blog',
        ],
        'contact' => [
            'meta_title' => 'Kontak HVM Digital — Hubungi Kami Sekarang',
            'meta_description' => 'Hubungi HVM Digital untuk konsultasi gratis. WhatsApp: +62851-7998-2373. Email: bisnis@hvmdigital.id. Kantor Surabaya & Bekasi.',
            'meta_keywords' => 'kontak HVM Digital, hubungi HVM Digital, konsultasi website gratis, WhatsApp HVM Digital',
        ],
    ];

    public function __construct(private ImageService $img) {}

    public function index()
    {
        $corePages = $this->corePages;
        $cities = config('cities', []);
        $landingPages = LandingPage::all()->keyBy('city_key');
        $services = Service::orderBy('sort_order')->get();

        return view('admin.page-management.index', compact('corePages', 'cities', 'landingPages', 'services'));
    }

    public function editCore(string $pageKey)
    {
        if (!isset($this->corePages[$pageKey])) {
            abort(404);
        }

        $pageInfo = $this->corePages[$pageKey];
        
        $metaTitle = setting("{$pageKey}_meta_title") ?: ($this->defaultSEO[$pageKey]['meta_title'] ?? '');
        $metaDescription = setting("{$pageKey}_meta_description") ?: ($this->defaultSEO[$pageKey]['meta_description'] ?? '');
        $metaKeywords = setting("{$pageKey}_meta_keywords") ?: ($this->defaultSEO[$pageKey]['meta_keywords'] ?? '');
        $ogImage = setting("{$pageKey}_og_image");

        $faqs = Faq::where('category', "page:{$pageKey}")->orderBy('sort_order')->get();

        return view('admin.page-management.edit-core', compact(
            'pageKey', 'pageInfo', 'metaTitle', 'metaDescription', 'metaKeywords', 'ogImage', 'faqs'
        ));
    }

    public function updateCore(Request $request, string $pageKey)
    {
        if (!isset($this->corePages[$pageKey])) {
            abort(404);
        }

        $request->validate([
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:320',
            'meta_keywords'    => 'nullable|string',
            'og_image'         => 'nullable|image|max:4096',
        ]);

        // 1. Save SEO Settings
        setting([
            "{$pageKey}_meta_title"       => $request->input('meta_title'),
            "{$pageKey}_meta_description" => $request->input('meta_description'),
            "{$pageKey}_meta_keywords"    => $request->input('meta_keywords'),
        ]);

        // 2. Handle Custom OpenGraph WebP Image
        if ($request->hasFile('og_image')) {
            $oldImage = setting("{$pageKey}_og_image");
            if ($oldImage) {
                $this->img->delete($oldImage);
            }
            $result = $this->img->uploadAndConvert($request->file('og_image'), 'pages/og', 1200, 80, 'og-' . $pageKey);
            setting(["{$pageKey}_og_image" => $result['path']]);
        }

        // 3. Sync FAQs
        $faqData = $request->input('faqs', []);
        $keepIds = [];
        foreach ($faqData as $f) {
            if (!empty($f['question']) && !empty($f['answer'])) {
                $faq = Faq::updateOrCreate(
                    [
                        'id'       => $f['id'] ?? null,
                        'category' => "page:{$pageKey}"
                    ],
                    [
                        'question'   => $f['question'],
                        'answer'     => $f['answer'],
                        'city_key'   => null,
                        'sort_order' => $f['sort_order'] ?? 0,
                        'is_active'  => isset($f['is_active']) ? (bool)$f['is_active'] : true,
                    ]
                );
                $keepIds[] = $faq->id;
            }
        }
        Faq::where('category', "page:{$pageKey}")->whereNotIn('id', $keepIds)->delete();

        setting()->save();

        return redirect()->route('admin.page-management.index')
            ->with('success', "Konfigurasi halaman {$this->corePages[$pageKey]['name']} berhasil diperbarui!");
    }
}
