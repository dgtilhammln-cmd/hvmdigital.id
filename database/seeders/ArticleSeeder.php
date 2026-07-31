<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Get categories by slug
        $catSeo   = ArticleCategory::where('slug', 'seo-geo')->first();
        $catAI    = ArticleCategory::where('slug', 'ai-chatbot-virtual-assistant')->first();
        $catUMKM  = ArticleCategory::where('slug', 'go-online-untuk-umkm')->first();

        $articles = [
            [
                'title'               => 'Panduan Lengkap SEO & GEO 2025: Cara Muncul di Google dan AI Search',
                'excerpt'             => 'SEO kini bukan hanya soal Google — Generative Engine Optimization (GEO) hadir untuk memastikan bisnis Anda ditemukan di ChatGPT, Perplexity, dan AI search engine lainnya. Pelajari strateginya di sini.',
                'content'             => '<h2>Apa Itu GEO dan Mengapa Penting di 2025?</h2>
<p>Selama bertahun-tahun, SEO (Search Engine Optimization) adalah satu-satunya cara untuk memastikan website Anda ditemukan di mesin pencari. Namun di 2025, lanskap pencarian digital berubah drastis dengan hadirnya <strong>AI Search Engine</strong> seperti ChatGPT, Perplexity AI, Google SGE, dan lainnya.</p>
<p><strong>GEO (Generative Engine Optimization)</strong> adalah evolusi dari SEO — strategi untuk mengoptimalkan konten Anda agar dikutip dan ditampilkan oleh AI dalam jawaban-jawabannya.</p>

<h2>5 Strategi SEO + GEO yang Wajib Diterapkan</h2>
<h3>1. Optimasi Konten Berbasis Entitas (Entity-Based SEO)</h3>
<p>Google dan AI model memahami dunia melalui entitas — nama bisnis, lokasi, produk, dan orang. Pastikan website Anda memiliki schema markup yang tepat, khususnya <code>LocalBusiness</code>, <code>Organization</code>, dan <code>FAQPage</code>.</p>

<h3>2. Jawab Pertanyaan Secara Langsung</h3>
<p>AI suka mengutip konten yang menjawab pertanyaan secara langsung dan terstruktur. Gunakan format <strong>pertanyaan → jawaban ringkas → penjelasan detail</strong> di setiap artikel Anda.</p>

<h3>3. E-E-A-T: Experience, Expertise, Authoritativeness, Trustworthiness</h3>
<p>Google semakin mementingkan sinyal E-E-A-T. Sertakan bio penulis, referensi data, tanggal update artikel, dan link ke sumber terpercaya.</p>

<h3>4. Optimasi untuk Fitur AI Overviews</h3>
<p>Google AI Overviews mengutip konten yang memiliki struktur jelas dengan heading H2/H3, bullet points, dan data statistik. Pastikan artikel Anda mudah di-scan oleh AI.</p>

<h3>5. Membangun Kehadiran di Seluruh Platform</h3>
<p>Pastikan nama bisnis Anda konsisten di Google Business Profile, media sosial, dan direktori bisnis. Konsistensi NAP (Name, Address, Phone) adalah fondasi Local SEO dan GEO.</p>

<blockquote>
<p>Bisnis yang mengoptimalkan untuk GEO di 2025 akan memiliki keunggulan kompetitif besar saat AI Search menjadi channel utama penemuan bisnis.</p>
</blockquote>

<h2>Kesimpulan</h2>
<p>SEO dan GEO bukan pilihan, melainkan keharusan di era AI. Mulailah dengan mengaudit konten Anda, tambahkan schema markup, dan pastikan setiap halaman menjawab pertanyaan pengguna secara jelas dan otoritatif.</p>
<p>Butuh bantuan mengoptimalkan website Anda? <strong>HVM Digital</strong> siap membantu — dari audit SEO hingga implementasi GEO strategy.</p>',
                'category'            => 'SEO & GEO',
                'article_category_id' => $catSeo?->id,
                'meta_title'          => 'Panduan SEO & GEO 2025 — Strategi Muncul di Google dan AI Search | HVM Digital',
                'meta_description'    => 'Pelajari strategi SEO dan GEO terbaru 2025 untuk memastikan bisnis Anda ditemukan di Google, ChatGPT, dan AI search engine. Panduan lengkap dari tim HVM Digital.',
                'meta_keywords'       => 'SEO 2025, GEO optimization, AI search engine, Google SGE, local SEO, digital marketing',
                'status'              => 'published',
                'published_at'        => Carbon::now()->subDays(5),
                'views'               => 247,
            ],
            [
                'title'               => 'AI Chatbot untuk Bisnis: Hemat 80% Waktu Layanan Pelanggan dengan Otomasi Cerdas',
                'excerpt'             => 'AI Chatbot bukan lagi teknologi masa depan — ini adalah kebutuhan bisnis sekarang. Temukan bagaimana UMKM dan korporat di Indonesia menggunakan AI untuk merespons pelanggan 24/7 tanpa tambah SDM.',
                'content'             => '<h2>Mengapa Bisnis Anda Butuh AI Chatbot Sekarang?</h2>
<p>Data menunjukkan <strong>67% pelanggan mengharapkan respons dalam waktu kurang dari 1 jam</strong>, sementara rata-rata bisnis membutuhkan 10+ jam untuk merespons pertanyaan pelanggan. Gap ini menyebabkan kehilangan potensi penjualan yang besar.</p>
<p>AI Chatbot hadir sebagai solusi — sistem cerdas yang dapat merespons ribuan percakapan secara bersamaan, 24 jam sehari, 7 hari seminggu, tanpa biaya tambahan SDM.</p>

<h2>Apa yang Bisa Dilakukan AI Chatbot untuk Bisnis Anda?</h2>
<h3>1. Layanan Pelanggan Otomatis</h3>
<p>Jawab FAQ, cek status pesanan, proses keluhan, dan eskalasi isu kompleks ke tim manusia — semuanya tanpa intervensi manual untuk kasus-kasus rutin.</p>

<h3>2. Lead Generation & Kualifikasi</h3>
<p>Chatbot dapat menanyakan kebutuhan prospek, mengumpulkan data kontak, dan mengkualifikasi lead sebelum diserahkan ke tim sales. Konversi meningkat, waktu sales lebih efisien.</p>

<h3>3. Onboarding Pelanggan Baru</h3>
<p>Panduan penggunaan produk, tutorial, dan FAQ onboarding dapat disampaikan secara otomatis dan personal sesuai profil pelanggan.</p>

<h3>4. Integrasi WhatsApp, Instagram & Website</h3>
<p>AI Chatbot modern dapat diintegrasikan ke WhatsApp Business API, Instagram DM, website, dan platform lainnya dalam satu dashboard terpusat.</p>

<blockquote>
<p>Klien HVM Digital di sektor properti berhasil mengurangi waktu respons dari rata-rata 6 jam menjadi 3 menit setelah implementasi AI Chatbot, dengan peningkatan konversi lead sebesar 43%.</p>
</blockquote>

<h2>Berapa Investasi yang Dibutuhkan?</h2>
<p>Investasi AI Chatbot sangat bervariasi tergantung kompleksitas. Mulai dari solusi plug-and-play yang terjangkau hingga chatbot custom berbasis GPT-4 yang terintegrasi dengan sistem CRM Anda. HVM Digital menyediakan konsultasi gratis untuk menentukan solusi terbaik sesuai anggaran dan kebutuhan bisnis Anda.</p>',
                'category'            => 'Artificial Intelligence',
                'article_category_id' => $catAI?->id,
                'meta_title'          => 'AI Chatbot untuk Bisnis Indonesia — Hemat 80% Waktu CS | HVM Digital',
                'meta_description'    => 'Implementasi AI Chatbot untuk bisnis Anda. Respons pelanggan 24/7, integrasi WhatsApp & Instagram, hemat biaya SDM hingga 80%. Konsultasi gratis dengan HVM Digital.',
                'meta_keywords'       => 'AI chatbot, chatbot bisnis, otomasi layanan pelanggan, WhatsApp chatbot, AI untuk UMKM',
                'status'              => 'published',
                'published_at'        => Carbon::now()->subDays(12),
                'views'               => 389,
            ],
            [
                'title'               => 'UMKM Go Online 2025: 7 Langkah Membangun Kehadiran Digital dari Nol',
                'excerpt'             => 'Masih mengandalkan mulut ke mulut dan bazar lokal? Di era digital, UMKM yang tidak hadir online kehilangan 70% potensi pasar. Ikuti 7 langkah praktis ini untuk memulai perjalanan digital bisnis Anda.',
                'content'             => '<h2>Mengapa UMKM Wajib Go Online di 2025?</h2>
<p>Lebih dari <strong>200 juta pengguna internet di Indonesia</strong> aktif mencari produk dan layanan secara online setiap hari. UMKM yang tidak hadir digital secara efektif hanya menjangkau segelintir pelanggan di sekitar lokasi fisiknya.</p>
<p>Go online bukan sekadar punya akun media sosial — ini tentang membangun ekosistem digital yang bekerja untuk bisnis Anda bahkan saat Anda tidur.</p>

<h2>7 Langkah UMKM Go Online yang Efektif</h2>
<h3>Langkah 1: Daftarkan Google Business Profile</h3>
<p>Ini GRATIS dan wajib. Google Business Profile memastikan bisnis Anda muncul di Google Maps dan Google Search saat pelanggan mencari produk/layanan di area Anda. Lengkapi dengan foto, jam operasional, dan nomor telepon.</p>

<h3>Langkah 2: Buat Website Profesional</h3>
<p>Website adalah "toko online" Anda yang bekerja 24/7. Dengan website, Anda memiliki kendali penuh atas brand, tidak bergantung pada platform marketplace yang bisa berubah kebijakan kapan saja.</p>

<h3>Langkah 3: Aktifkan WhatsApp Business</h3>
<p>WhatsApp Business gratis dan memungkinkan Anda memisahkan komunikasi personal dan bisnis, mengatur pesan otomatis, membuat katalog produk, dan menggunakan label pelanggan.</p>

<h3>Langkah 4: Pilih 1-2 Platform Media Sosial</h3>
<p>Jangan coba hadir di semua platform sekaligus. Pilih yang paling relevan dengan target pasar Anda. Untuk B2C produk visual: Instagram. Untuk B2B dan konten edukasi: LinkedIn atau YouTube.</p>

<h3>Langkah 5: Daftarkan di Marketplace yang Relevan</h3>
<p>Tokopedia, Shopee, atau marketplace spesifik industri Anda bisa menjadi channel tambahan. Tapi ingat: marketplace sebaiknya pelengkap, bukan satu-satunya saluran penjualan.</p>

<h3>Langkah 6: Mulai Konten Marketing Sederhana</h3>
<p>Posting secara konsisten tentang produk, proses produksi, testimoni pelanggan, dan tips relevan. Konten yang autentik dan konsisten lebih efektif daripada konten sempurna yang jarang tayang.</p>

<h3>Langkah 7: Ukur dan Optimalkan</h3>
<p>Pasang Google Analytics di website Anda. Lihat dari mana pengunjung datang, halaman apa yang paling sering dikunjungi, dan konversi apa yang terjadi. Data ini adalah kompas untuk keputusan marketing Anda.</p>

<blockquote>
<p>UMKM batik rumahan di Solo yang dibimbing HVM Digital berhasil meningkatkan omzet 3x lipat dalam 6 bulan pertama go digital, dari Rp 15 juta/bulan menjadi Rp 47 juta/bulan.</p>
</blockquote>

<h2>Mulai Sekarang, Bukan Besok</h2>
<p>Setiap hari tanpa kehadiran digital adalah hari yang kehilangan pelanggan potensial kepada kompetitor yang sudah online. HVM Digital menyediakan paket Go Digital khusus UMKM — dari setup website, Google Business, hingga pelatihan konten marketing dengan investasi yang terjangkau.</p>',
                'category'            => 'Bisnis Lokal & UMKM',
                'article_category_id' => $catUMKM?->id,
                'meta_title'          => 'UMKM Go Online 2025: 7 Langkah Membangun Bisnis Digital dari Nol | HVM Digital',
                'meta_description'    => '7 langkah praktis UMKM go online di 2025. Dari Google Business Profile, website profesional, hingga strategi konten marketing yang terbukti efektif.',
                'meta_keywords'       => 'UMKM go online, bisnis digital, google business profile, website UMKM, digital marketing UMKM',
                'status'              => 'published',
                'published_at'        => Carbon::now()->subDays(20),
                'views'               => 512,
            ],
            [
                'title'               => 'HVM Digital.id Hadir di RRI Surabaya, Buktikan Kreativitas Anak Muda Relevan di Industri Digital',
                'excerpt'             => 'HVM Digital.id, agensi digital berbasis B2B industrial asal Surabaya, tampil di program Berkah Ramadhan Pro 2 RRI Surabaya dan berbagi perspektif segar soal industri digital korporat yang dibangun oleh anak muda kreatif.',
                'content'             => '<p>Surabaya, Februari 2026 — Nama HVM Digital.id mungkin belum sepopuler agensi-agensi besar yang sudah lama berdiri. Tapi pada akhir Februari 2026, nama itu mengudara — harafiah — di frekuensi <strong>Pro 2 RRI Surabaya</strong>, salah satu kanal radio milik Lembaga Penyiaran Publik yang telah lama menjadi rujukan informasi masyarakat Indonesia.</p>

<p>Ilham Maulana, Founder & Business Development HVM Digital.id, diundang hadir dalam segmen <em>Berkah Ramadhan</em> — sebuah program yang mengangkat kisah-kisah inspiratif dari para pelaku usaha muda di Surabaya. Di sini ia berbicara bukan sekadar soal bisnis, tapi soal cara pandang baru terhadap industri digital yang selama ini kerap diidentikkan dengan usia dan pengalaman panjang.</p>

<h2>Ketika Frekuensi Nasional Menyapa Agensi dengan Pendekatan Berbeda</h2>

<p>Di tengah ratusan agensi digital yang tumbuh di Surabaya dan mayoritas berfokus menyasar segmen UMKM, HVM Digital.id secara sadar memilih jalur yang berbeda: <strong>B2B industrial</strong>.</p>

<p>Artinya, klien yang dituju bukan pelaku usaha kecil yang sedang mencari jasa desain logo. HVM Digital.id hadir untuk perusahaan-perusahaan yang membutuhkan <strong>solusi digital marketing terintegrasi</strong> — mulai dari pembuatan website, pengelolaan konten digital, branding, hingga pengembangan sistem komunikasi korporat berbasis digital.</p>

<blockquote>
  <p>"Kalau ditanya HVM Digital.id ini apa, kita bisa dibilang agency dengan fokus B2B industrial." — Ilham Maulana, Founder & Business Development HVM Digital.id</p>
</blockquote>

<p>Pilihan ini bukan tanpa pertimbangan. Diferensiasi adalah kunci di industri kreatif digital yang semakin padat — dan HVM Digital.id memilihnya sejak hari pertama, bukan sebagai strategi reaktif, melainkan sebagai fondasi yang disengaja.</p>

<h2>Tim Muda dengan Jam Terbang yang Tidak Muda</h2>

<p>Salah satu hal yang kerap menjadi pertimbangan klien korporat saat berhadapan dengan agensi adalah soal kapabilitas. Wajar. Dunia B2B menuntut presisi, konsistensi, dan pemahaman mendalam terhadap kebutuhan bisnis yang kompleks.</p>

<p>HVM Digital.id menjawab ini dengan komposisi tim. Para praktisi di dalamnya sudah mengasah keahlian masing-masing jauh sebelum HVM berdiri — dari digital marketing, pengembangan website, branding, hingga komunikasi korporat.</p>

<blockquote>
  <p>"Walaupun baru, teman-teman di dalamnya adalah orang lama di bidang ini." — Ilham Maulana, Founder & Business Development HVM Digital.id</p>
</blockquote>

<p>Dan pengalaman itu bukan sekadar klaim. Hasilnya sudah bisa diukur dari pekerjaan yang ada.</p>

<h2>Hasil Nyata yang Berbicara untuk Klien</h2>

<p>Bagi pemilik bisnis, satu pertanyaan selalu menjadi penentu: <em>apakah investasi digital ini benar-benar menghasilkan?</em> HVM Digital.id memahami tekanan itu — dan memilih untuk menjawabnya dengan data, bukan janji.</p>

<p>Salah satu klien HVM Digital.id di industri hukum — sebuah law firm yang berfokus pada layanan perceraian di Jakarta — datang dengan satu masalah mendasar: website sudah ada, tapi tidak ada yang menemukannya. Calon klien yang sedang mencari bantuan hukum di Jakarta tidak sampai ke halaman mereka. Bisnis berjalan dari mulut ke mulut saja, tanpa saluran digital yang bekerja.</p>

<p>Tim HVM Digital.id menggarap strategi SEO secara menyeluruh — struktur halaman, optimasi konten, hingga penguatan sinyal relevansi untuk kata kunci yang benar-benar digunakan calon klien saat membutuhkan bantuan hukum. Hasilnya: <strong>dalam kurang dari satu bulan sejak website diluncurkan, firma hukum tersebut sudah muncul di halaman pertama Google untuk kata kunci "pengacara perceraian Jakarta"</strong> — salah satu kata kunci dengan persaingan tertinggi di industri hukum Indonesia.</p>

<p>Dampaknya langsung terasa di level bisnis. Calon klien yang sebelumnya tidak tahu keberadaan firma ini kini bisa menemukannya hanya dengan satu kali pencarian. Akses yang mudah berarti peluang konsultasi yang lebih besar — dan pada akhirnya, pertumbuhan klien yang bisa diukur secara nyata.</p>

<p>Inilah yang dimaksud dengan <strong>orientasi hasil</strong>: bukan sekadar website yang terlihat bagus, tapi kehadiran digital yang benar-benar bekerja untuk mendatangkan bisnis.</p>

<h2>Filosofi Kerja yang Relevan untuk Klien Korporat</h2>

<p>Di balik setiap proyek, ada satu prinsip yang menggerakkan cara tim HVM Digital.id bekerja.</p>

<blockquote>
  <p>"Kalau jalur satu tidak berhasil, saya pilih jalur lain, bukan berhenti." — Ilham Maulana, Founder & Business Development HVM Digital.id</p>
</blockquote>

<p>Prinsip adaptif ini adalah cara tim HVM menghadapi tantangan di lapangan. Ketika strategi pertama tidak menghasilkan traksi yang diharapkan, tim tidak berhenti — mereka menganalisis, menyesuaikan, dan mencoba jalur lain hingga hasil yang terukur tercapai. Bagi pemilik bisnis yang sudah terlalu sering mendengar janji tanpa realisasi, pendekatan seperti ini adalah perbedaan yang nyata.</p>

<p>Pemilihan tim pun dilakukan secara selektif — bukan sekadar mengumpulkan orang yang bisa bekerja, tapi orang yang tepat untuk posisi yang tepat. Karena kualitas output klien sangat bergantung pada kecocokan keahlian tim dengan kebutuhan proyeknya.</p>

<h2>Apa Artinya Ini bagi Perusahaan yang Sedang Mencari Mitra Digital?</h2>

<p>Kehadiran HVM Digital.id di RRI Surabaya bukan sekadar momen visibilitas. Ini adalah sinyal bahwa ada pilihan baru di pasar agensi digital — pilihan yang dibangun khusus untuk kebutuhan korporat, dijalankan oleh tim berpengalaman, dengan pendekatan yang terukur dan berorientasi pada pertumbuhan bisnis klien.</p>

<p>Untuk pemilik bisnis dan decision maker di perusahaan: pertanyaan yang relevan bukan lagi <em>"apakah kami perlu hadir secara digital?"</em> — melainkan <em>"apakah kehadiran digital kami saat ini benar-benar bekerja untuk mendatangkan klien dan membuka peluang baru?"</em></p>

<p>Jika jawabannya belum memuaskan, HVM Digital.id hadir dengan perspektif yang berbeda: <strong>kami bukan agensi generalis yang mencoba melayani semua orang.</strong> Kami fokus pada B2B industrial — dan fokus itu yang membuat pendekatan kami relevan, terukur, dan berdampak langsung pada bisnis Anda.</p>

<p>Konsultasikan kebutuhan digital perusahaan Anda bersama tim HVM Digital.id dan temukan bagaimana strategi yang tepat dapat menjadi aset pertumbuhan bisnis jangka panjang.</p>',
                'category'            => 'Bisnis Lokal & UMKM',
                'article_category_id' => $catUMKM?->id,
                'meta_title'          => 'HVM Digital.id Hadir di RRI Surabaya, Buktikan Kreativitas Anak Muda Relevan di Industri Digital',
                'meta_description'    => 'HVM Digital.id, agensi digital berbasis B2B industrial asal Surabaya, tampil di program Berkah Ramadhan Pro 2 RRI Surabaya dan berbagi perspektif segar soal industri digital korporat yang dibangun oleh anak muda kreatif.',
                'meta_keywords'       => 'HVM Digital, agensi digital Surabaya, B2B digital marketing, RRI Surabaya, pengusaha muda Surabaya, digital agency B2B industrial, Ilham Maulana',
                'status'              => 'published',
                'published_at'        => Carbon::parse('2026-02-27 23:44:00'),
                'views'               => 542,
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($data['title'])],
                $data
            );
        }
    }
}
