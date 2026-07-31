<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Faq;
use App\Models\Portfolio;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function index(): View
    {
        $services = Service::active()->get();

        $seo = $this->seo->forPage('services', [
            'title'       => setting('services_meta_title', 'Layanan HVM Digital — Digital Marketing & IT Solution'),
            'description' => setting('services_meta_description', 'Layanan lengkap HVM Digital: Pembuatan Website, SEO, Google Ads, Social Media Management, Aplikasi Custom, dan IT Solution untuk bisnis Anda di seluruh Indonesia.'),
            'keywords'    => setting('services_meta_keywords', 'layanan digital marketing, jasa pembuatan website, SEO profesional, Google Ads, aplikasi custom, IT solution indonesia'),
            'schemas'     => [
                $this->schema->organization(),
                $this->schema->breadcrumb([
                    ['name' => 'Home', 'url' => url('/')],
                    ['name' => 'Layanan', 'url' => route('services')],
                ]),
            ],
        ]);

        return view('pages.services.index', compact('seo', 'services'));
    }

    public function show(Service $service): View
    {
        if (!$service->is_active) abort(404);

        // Cek FAQ dari database berdasarkan kategori slug layanan. Jika kosong, gunakan FAQ spesifik dinamis.
        $dbFaqs = Faq::where('category', $service->slug)->active()->get();
        if ($dbFaqs->count() > 0) {
            $faqs = $dbFaqs;
        } else {
            $dynamicFaqs = match ($service->slug) {
                'jasa-pembuatan-website-profesional', 'jasa-pembuatan-website', 'pembuatan-website' => [
                    ['question' => 'Berapa lama waktu pengerjaan website di HVM Digital?', 'answer' => 'Waktu pengerjaan bervariasi mulai dari 3-5 hari kerja untuk landing page profesional, 7-14 hari untuk company profile komprehensif, dan 14-30 hari untuk toko online berkinerja tinggi. Kami menjamin pengerjaan tepat waktu sesuai jadwal yang disepakati.'],
                    ['question' => 'Apakah website yang dibuat sudah ramah seluler (mobile-friendly)?', 'answer' => 'Tentu saja! Seluruh website kami dirancang menggunakan pendekatan mobile-first. Tampilan akan beradaptasi secara mulus dan responsif di berbagai perangkat seperti smartphone, tablet, laptop, dan desktop.'],
                    ['question' => 'Apakah ada garansi revisi desain?', 'answer' => 'Ya, kami memberikan garansi revisi gratis hingga 3 kali pada tahap awal desain UI/UX sebelum masuk ke proses pengembangan (development) inti untuk memastikan hasil akhir sesuai dengan visi bisnis Anda.'],
                    ['question' => 'Apakah layanan ini melayani klien di seluruh Indonesia?', 'answer' => 'Sangat bisa! Kami melayani klien dari Sabang sampai Merauke secara profesional. Proses pengerjaan, pelaporan, dan diskusi dilakukan secara online dan terstruktur melalui WhatsApp, Zoom, dan Google Meet.'],
                    ['question' => 'Apakah website sudah dioptimalkan untuk SEO dasar?', 'answer' => 'Ya, setiap paket pembuatan website kami sudah dilengkapi dengan optimasi struktur kode, kecepatan muat (PageSpeed), dan pengaturan tag meta dasar agar mudah diindeks oleh Google.'],
                ],
                'search-engine-optimization-seo', 'jasa-optimasi-seo-halaman-1', 'seo-sem' => [
                    ['question' => 'Apa perbedaan utama antara SEO organik dan SEM (Google Ads)?', 'answer' => 'SEO berfokus pada peningkatan peringkat organik jangka panjang di halaman 1 Google tanpa biaya per klik. SEM (Google Ads) adalah iklan berbayar yang langsung menampilkan website Anda di posisi teratas, namun memerlukan anggaran per klik (PPC).'],
                    ['question' => 'Berapa lama waktu yang dibutuhkan untuk melihat hasil SEO?', 'answer' => 'SEO adalah strategi investasi jangka panjang. Secara umum, peningkatan peringkat dan lalu lintas organik yang signifikan akan mulai terlihat dalam 3 hingga 6 bulan tergantung pada tingkat kompetisi industri Anda.'],
                    ['question' => 'Apakah HVM Digital menggunakan teknik SEO yang aman?', 'answer' => 'Ya, kami 100% mematuhi panduan resmi Google (White-Hat SEO). Kami tidak   menggunakan teknik manipulatif (Black-Hat) yang berisiko membuat website Anda terkena penalti atau de-index.'],
                    ['question' => 'Apakah layanan SEO & SEM ini mencakup seluruh wilayah Indonesia?', 'answer' => 'Benar! Kami menargetkan kata kunci dengan cakupan nasional maupun spesifik per kota di seluruh Indonesia untuk memastikan bisnis Anda menjangkau calon pelanggan yang tepat di mana pun mereka berada.'],
                    ['question' => 'Bagaimana cara melacak performa kampanye SEO/SEM saya?', 'answer' => 'Kami menyediakan laporan bulanan yang komprehensif dan transparan, mencakup metrik lalu lintas kunjungan, posisi kata kunci, tayangan, serta jumlah prospek (leads) yang berhasil masuk.'],
                ],
                'generative-engine-optimization-geo', 'jasa-generative-engine-optimization' => [
                    ['question' => 'Apa itu Generative Engine Optimization (GEO)?', 'answer' => 'GEO adalah strategi optimasi modern agar merek dan produk Anda direkomendasikan secara positif oleh mesin pencari berbasis AI seperti ChatGPT, Google Gemini, dan Perplexity saat pengguna menanyakan rekomendasi bisnis di industri Anda.'],
                    ['question' => 'Bagaimana cara kerja optimasi GEO di HVM Digital?', 'answer' => 'Kami mengoptimalkan sebutan merek (brand mentions), kutipan otoritas, ulasan sentimen positif, serta penataan data terstruktur (JSON-LD) agar algoritma AI generatif memahami dan memprioritaskan bisnis Anda sebagai jawaban terbaik.'],
                    ['question' => 'Berapa lama waktu pengerjaan kampanye GEO?', 'answer' => 'Sama seperti SEO organik, GEO membutuhkan waktu pembentukan otoritas sekitar 3 hingga 6 bulan untuk mendominasi kutipan dan rekomendasi di berbagai model bahasa besar (LLM).'],
                    ['question' => 'Apakah layanan GEO ini tersedia untuk perusahaan di seluruh Indonesia?', 'answer' => 'Tentu saja! Kami melayani optimasi visibilitas AI untuk berbagai sektor bisnis dan perusahaan di seluruh wilayah Indonesia secara profesional.'],
                ],
                'social-media-management' => [
                    ['question' => 'Platform media sosial apa saja yang dikelola oleh HVM Digital?', 'answer' => 'Kami mengelola platform utama seperti Instagram, TikTok, Facebook, dan LinkedIn. Kami menyesuaikan strategi konten berdasarkan karakteristik audiens di masing-masing platform.'],
                    ['question' => 'Apakah layanan ini sudah termasuk pembuatan desain dan copywriting?', 'answer' => 'Ya, paket kami sudah mencakup perencanaan strategi, pembuatan desain grafis premium, video reels/TikTok pendek, copywriting yang memikat, hingga penjadwalan posting bulanan.'],
                    ['question' => 'Apakah saya perlu menyediakan bahan konten atau foto produk?', 'answer' => 'Anda dapat menyediakan foto/video mentah produk Anda, dan tim kreatif kami akan mengolahnya menjadi konten profesional. Jika Anda tidak memiliki bahan, kami dapat membantu dengan aset grafis premium dan lisensi resmi.'],
                    ['question' => 'Bagaimana cara HVM Digital meningkatkan interaksi (engagement) akun saya?', 'answer' => 'Kami menggunakan kombinasi riset tren terkini, penggunaan hashtag yang relevan, konten interaktif (kuis, poling, edukasi), serta tata letak visual (feed grid) yang memanjakan mata pengunjung.'],
                    ['question' => 'Apakah layanan manajemen media sosial ini berlaku untuk bisnis di seluruh Indonesia?', 'answer' => 'Tentu! Kami melayani berbagai skala bisnis di seluruh Indonesia dengan alur persetujuan konten (content calendar) yang mudah diakses secara online sebelum dipublikasikan.'],
                ],
                'desain-branding-perusahaan', 'desain-grafis-branding', 'jasa-desain-branding-perusahaan' => [
                    ['question' => 'Apa saja yang termasuk dalam paket branding bisnis?', 'answer' => 'Paket branding kami mencakup pembuatan logo profesional, panduan identitas merek (brand guidelines), palet warna, tipografi, kartu nama, kop surat, hingga template media sosial.'],
                    ['question' => 'Mengapa identitas visual (branding) yang kuat sangat penting?', 'answer' => 'Branding yang konsisten dan elegan membedakan bisnis Anda dari kompetitor, membangun kepercayaan (trust) seketika di mata pelanggan, dan memberikan kesan premium pada produk atau layanan Anda.'],
                    ['question' => 'Berapa lama proses pengerjaan desain logo dan branding?', 'answer' => 'Proses eksplorasi konsep dan pengerjaan awal biasanya memakan waktu 5 hingga 10 hari kerja. Kami menyajikan beberapa alternatif konsep logo terbaik untuk Anda pilih.'],
                    ['question' => 'Apakah saya akan mendapatkan file master (source file)?', 'answer' => 'Ya, setelah proyek selesai dan disetujui, Anda akan mendapatkan seluruh file master dalam berbagai format resolusi tinggi (AI, EPS, PDF, PNG, SVG) yang siap cetak dan digital.'],
                    ['question' => 'Apakah layanan desain grafis ini melayani perusahaan di seluruh Indonesia?', 'answer' => 'Tentu saja! Kami bekerja sama dengan berbagai perusahaan, startup, dan UMKM di seluruh Indonesia melalui proses taklimat (brief) desain yang terstruktur secara online.'],
                ],
                'content-creator' => [
                    ['question' => 'Apa saja fokus konten yang diproduksi oleh layanan Content Creator HVM Digital?', 'answer' => 'Kami memproduksi video pendek vertikal (Reels, TikTok, YouTube Shorts), video profil perusahaan, serta foto produk estetik yang dirancang khusus untuk memikat audiens dan meningkatkan konversi.'],
                    ['question' => 'Apakah HVM Digital menyediakan talent / host untuk video?', 'answer' => 'Ya, kami memiliki jaringan talent dan KOL/influencer profesional yang siap menjadi wajah merek Anda dalam menyampaikan pesan promosi yang persuasif dan natural.'],
                    ['question' => 'Bagaimana alur persetujuan konsep sebelum syuting?', 'answer' => 'Kami menyusun naskah (script) dan papan cerita (storyboard) terperinci untuk Anda tinjau dan setujui terlebih dahulu sebelum tim produksi kami melakukan pengambilan gambar (syuting).'],
                    ['question' => 'Apakah layanan Content Creator melayani luar kota Surabaya?', 'answer' => 'Sangat bisa! Untuk produk fisik, Anda cukup mengirimkan sampel produk ke studio kami. Untuk syuting di lokasi bisnis Anda di luar kota, kami menyediakan paket akomodasi tim produksi yang transparan.'],
                    ['question' => 'Apakah hasil video sudah termasuk editing dan musik berlisensi?', 'answer' => 'Tentu! Semua video yang kami serahkan sudah melalui proses editing premium (color grading, transisi, efek suara) serta menggunakan musik berlisensi resmi agar aman dari pelanggaran hak cipta.'],
                ],
                'digital-ads-google-meta-ads', 'digital-advertising', 'jasa-digital-advertising' => [
                    ['question' => 'Saluran iklan digital apa saja yang dikuasai oleh HVM Digital?', 'answer' => 'Kami ahli dalam merancang dan mengoptimalkan kampanye iklan di Google Ads (Search, Display, YouTube), Meta Ads (Facebook & Instagram), TikTok Ads, serta iklan marketplace.'],
                    ['question' => 'Bagaimana cara HVM Digital mengoptimalkan anggaran iklan (budget) saya?', 'answer' => 'Kami melakukan riset audiens mendalam, pengujian A/B pada materi iklan, dan penargetan ulang (retargeting) untuk memastikan setiap rupiah yang Anda keluarkan menghasilkan konversi tertinggi (ROAS/ROI).'],
                    ['question' => 'Berapa anggaran iklan harian/bulanan yang disarankan?', 'answer' => 'Anggaran iklan sangat fleksibel dan disesuaikan dengan skala target Anda. Kami dapat membantu merumuskan estimasi anggaran yang paling efisien berdasarkan analisis biaya per klik (CPC) di industri Anda.'],
                    ['question' => 'Apakah kampanye iklan dapat ditargetkan ke kota/provinsi tertentu di Indonesia?', 'answer' => 'Sangat bisa! Kami menggunakan penargetan geografis (geo-targeting) yang akurat untuk menjangkau calon pelanggan di seluruh Indonesia atau mengerucut pada wilayah/kota tertentu sesuai fokus pasar Anda.'],
                    ['question' => 'Apakah saya akan mendapatkan laporan performa iklan?', 'answer' => 'Ya, kami memberikan dasbor dan laporan analitik berkala yang menyajikan data transparansi tayangan, klik, biaya, dan hasil konversi secara terperinci.'],
                ],
                'aplikasi-custom-it-solution', 'jasa-pembuatan-aplikasi-mobile' => [
                    ['question' => 'Jenis aplikasi custom apa saja yang bisa dikembangkan oleh HVM Digital?', 'answer' => 'Kami mengembangkan berbagai sistem berbasis web dan mobile (Android/iOS) seperti sistem ERP, CRM, portal HRIS, sistem kasir (POS), manajemen inventaris, hingga dasbor analitik khusus.'],
                    ['question' => 'Teknologi apa yang digunakan untuk pengembangan aplikasi?', 'answer' => 'Kami menggunakan teknologi tumpukan modern yang terbukti cepat, aman, dan dapat diskalakan (scalable) seperti Laravel, Vue.js, React, Flutter, dan arsitektur database MySQL/PostgreSQL.'],
                    ['question' => 'Apakah ada jaminan keamanan data dan kode sumber?', 'answer' => 'Ya, kami menerapkan standar keamanan tingkat tinggi termasuk enkripsi data, perlindungan CSRF/XSS, dan arsitektur server yang tangguh. Hak cipta dan kode sumber akan menjadi milik Anda sesuai perjanjian.'],
                    ['question' => 'Apakah HVM Digital menyediakan layanan pemeliharaan (maintenance) aplikasi?', 'answer' => 'Tentu! Kami menyediakan paket dukungan pasca-peluncuran dan pemeliharaan server berkala untuk memastikan aplikasi Anda berjalan stabil 24/7 tanpa kendala teknis.'],
                    ['question' => 'Apakah layanan pengembangan IT ini mencakup seluruh wilayah Indonesia?', 'answer' => 'Benar! Kami melayani konsultasi, pengembangan, dan penerapan solusi IT untuk instansi, perusahaan, dan pabrik di seluruh Indonesia dengan alur manajemen proyek online yang transparan.'],
                ],
                default => [
                    ['question' => "Apa keunggulan utama layanan {$service->name} di HVM Digital?", 'answer' => "Kami menghadirkan strategi dan eksekusi {$service->name} yang terukur, berfokus pada hasil nyata (ROI), dan dikerjakan oleh tim profesional berpengalaman."],
                    ['question' => "Apakah layanan {$service->name} ini tersedia untuk klien di seluruh Indonesia?", 'answer' => "Tentu saja! Kami melayani perusahaan dan bisnis di seluruh wilayah Indonesia secara profesional melalui alur kerja digital yang cepat dan transparan."],
                    ['question' => "Bagaimana alur kerja dan pelaporan untuk layanan ini?", 'answer' => "Kami memulai dengan sesi konsultasi mendalam, penyusunan strategi, eksekusi terarah, hingga penyampaian laporan performa berkala yang transparan."],
                    ['question' => "Bagaimana cara memulai konsultasi untuk layanan ini?", 'answer' => "Sangat mudah! Anda cukup menghubungi tim konsultan kami melalui tombol WhatsApp yang tersedia untuk berdiskusi dan mendapatkan penawaran terbaik."],
                ],
            };
            $faqs = collect($dynamicFaqs)->map(fn($item) => (object)$item);
        }

        $ogImage = $service->og_image ? get_image_url($service->og_image) : null;

        $seo = $this->seo->generate([
            'title'       => $service->meta_title ?: "{$service->name} Profesional | HVM Digital",
            'description' => $service->meta_description ?: "Layanan {$service->name} terbaik dari HVM Digital untuk meningkatkan performa bisnis Anda di seluruh Indonesia.",
            'keywords'    => $service->meta_keywords ?: "jasa {$service->name}, {$service->name} profesional, hvm digital indonesia",
            'og_image'    => $ogImage,
            'schemas'     => [
                $this->schema->organization(),
                $this->schema->service($service),
                $this->schema->faq($faqs->toArray()),
                $this->schema->breadcrumb([
                    ['name' => 'Home', 'url' => url('/')],
                    ['name' => 'Layanan', 'url' => route('services')],
                    ['name' => $service->name, 'url' => url()->current()],
                ]),
            ],
        ]);

        $portfolios = Portfolio::active()->take(6)->get();

        return view('pages.services.show', compact('seo', 'service', 'faqs', 'portfolios'));
    }

    public function seoPage(): View
    {
        $seoFaqsArray = [
            ['question' => 'Berapa lama waktu yang dibutuhkan agar website saya masuk Halaman 1 Google?', 'answer' => 'SEO adalah investasi jangka panjang dan tidak menjanjikan hasil instan (berbeda dengan iklan berbayar/Google Ads). Secara umum, Anda akan mulai melihat pergerakan positif dalam 3 hingga 6 bulan. Waktu pastinya sangat bergantung pada tingkat kompetisi industri Anda, otoritas website Anda saat ini, dan kondisi teknis website. Kami berfokus pada teknik White-Hat SEO yang aman dan memastikan peringkat Anda bertahan lama.'],
            ['question' => 'Apakah ada jaminan pasti peringkat 1 di Google?', 'answer' => 'Tidak ada agensi SEO profesional di dunia yang bisa menjamin peringkat #1 mutlak. Yang HVM Digital jamin adalah penerapan strategi dan optimasi sesuai panduan resmi Google (Best Practices), laporan analitik yang 100% transparan, serta dedikasi tim kami untuk menargetkan kata kunci yang menghasilkan prospek (leads) dan keuntungan nyata (ROI) bagi bisnis Anda.'],
            ['question' => 'Apa bedanya SEO dengan Google Ads (Iklan Berbayar)?', 'answer' => 'Google Ads (SEM) ibarat menyewa ruang iklan: langsung tampil di atas, namun begitu budget habis, langsung menghilang. SEO ibarat membangun aset properti: membutuhkan waktu untuk dibangun, namun saat website Anda sudah mendominasi halaman 1 secara organik, Anda akan terus mendapatkan trafik setiap hari tanpa perlu membayar biaya klik (PPC) ke Google.'],
            ['question' => 'Apakah layanan ini sudah termasuk perbaikan website?', 'answer' => 'Ya, untuk perbaikan teknis skala menengah seperti optimasi kecepatan (PageSpeed), perbaikan struktur URL, meta tags, dan perbaikan error indexing, tim developer kami akan menanganinya secara langsung (Technical SEO). Namun, sebagai langkah edukasi: jika platform atau struktur dasar website Anda saat ini sudah usang, menggunakan sistem tertutup yang tidak ramah SEO, atau memiliki kode yang sangat berat/kotor, maka optimasi tidak akan berjalan optimal. Dalam kasus tersebut, kami akan memberikan transparansi penuh di awal dan menyarankan untuk melakukan rebuild (pembuatan ulang) website menggunakan standar teknologi modern yang terbukti SEO-friendly.'],
            ['question' => 'Bagaimana saya tahu jika investasi SEO saya membuahkan hasil?', 'answer' => 'Kami tidak hanya memberikan laporan peringkat (ranking). HVM Digital akan mengirimkan laporan performa komprehensif setiap bulan yang mencakup pertumbuhan trafik organik, peningkatan tayangan (impressions) dan klik (CTR), serta konversi atau prospek (leads) yang masuk.'],
        ];

        $seo = $this->seo->forPage('services.seo', [
            'title'       => 'Jasa Optimasi SEO Halaman 1 | HVM Digital',
            'description' => 'Jasa SEO Profesional terpercaya seluruh Indonesia — ratusan leads organik per bulan, laporan transparan, White-Hat SEO. Konsultasi gratis hari ini!',
            'keywords'    => 'jasa optimasi seo, seo halaman 1, jasa seo indonesia, jasa seo b2b, hvm digital',
            'schemas'     => [
                $this->schema->organization(),
                $this->schema->seoService(),
                $this->schema->faq($seoFaqsArray),
                $this->schema->breadcrumb([
                    ['name' => 'Home', 'url' => url('/')],
                    ['name' => 'Layanan', 'url' => route('services')],
                    ['name' => 'Jasa Optimasi SEO Halaman 1', 'url' => url()->current()],
                ]),
            ],
        ]);

        $faqs = collect($seoFaqsArray)->map(fn($item) => (object)$item);

        return view('pages.services.seo', compact('seo', 'faqs'));
    }
}
