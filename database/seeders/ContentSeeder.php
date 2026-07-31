<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // === SERVICES ===
        $services = [
            ['name' => 'Jasa Pembuatan Website Profesional', 'icon' => 'monitor', 'short_description' => 'Company profile, toko online, landing page, dan sistem web — responsive, cepat, SEO-ready sejak hari pertama.', 'price_start' => 500000, 'sort_order' => 1],
            ['name' => 'Search Engine Optimization (SEO)', 'icon' => 'search', 'short_description' => 'Strategi SEO berbasis data untuk membawa bisnis Anda ke halaman 1 Google — organik, terukur, dan berkelanjutan.', 'price_start' => 1500000, 'sort_order' => 2],
            ['name' => 'Generative Engine Optimization (GEO)', 'icon' => 'ai', 'short_description' => 'Optimalkan visibilitas bisnis di AI — ChatGPT, Google Gemini, Perplexity, dan platform AI generatif lainnya.', 'price_start' => 2000000, 'sort_order' => 3],
            ['name' => 'Aplikasi Custom & IT Solution', 'icon' => 'smartphone', 'short_description' => 'Aplikasi Android, iOS, ERP, CRM, dan sistem custom yang benar-benar sesuai kebutuhan bisnis Anda.', 'price_start' => 5000000, 'sort_order' => 4],
            ['name' => 'Desain & Branding Perusahaan', 'icon' => 'palette', 'short_description' => 'Identitas visual yang kuat — logo, brand guideline, konten visual, dan materi pemasaran premium.', 'price_start' => 500000, 'sort_order' => 5],
            ['name' => 'Content Creator', 'icon' => 'video', 'short_description' => 'Konten engaging dan on-brand untuk Instagram, TikTok, YouTube — dari strategi hingga eksekusi produksi.', 'price_start' => 1500000, 'sort_order' => 6],
            ['name' => 'Social Media Management', 'icon' => 'share', 'short_description' => 'Pengelolaan akun Instagram, Facebook, TikTok, dan LinkedIn — strategi konten, posting konsisten, engagement aktif.', 'price_start' => 1000000, 'sort_order' => 7],
            ['name' => 'Digital Ads (Google & Meta Ads)', 'icon' => 'trending', 'short_description' => 'Iklan Google Search, Display, YouTube, serta Meta Ads untuk jangkauan dan konversi maksimal.', 'price_start' => 2000000, 'sort_order' => 8],
        ];

        Service::truncate();
        foreach ($services as $s) {
            Service::updateOrCreate(['name' => $s['name']], array_merge($s, ['is_active' => true]));
        }

        // === FAQs ===
        $faqs = [
            ['question' => 'Berapa harga jasa pembuatan website di HVM Digital?', 'answer' => 'Harga jasa pembuatan website di HVM Digital mulai dari Rp 500.000 untuk landing page sederhana. Website company profile mulai Rp 1.500.000, toko online mulai Rp 3.000.000, dan aplikasi web custom mulai Rp 5.000.000. Hubungi kami untuk penawaran yang sesuai dengan kebutuhan bisnis Anda.', 'category' => 'pricing', 'sort_order' => 1],
            ['question' => 'Berapa lama pengerjaan website?', 'answer' => 'Waktu pengerjaan website bervariasi: landing page 3-5 hari kerja, company profile 7-14 hari kerja, toko online 14-30 hari kerja, dan aplikasi custom tergantung kompleksitas. Kami berkomitmen untuk menyelesaikan pekerjaan tepat waktu sesuai kesepakatan.', 'category' => 'general', 'sort_order' => 2],
            ['question' => 'Apakah ada garansi revisi?', 'answer' => 'Ya! Kami memberikan garansi revisi gratis hingga 3 kali untuk setiap paket website. Revisi dilakukan setelah presentasi desain awal dan sebelum tahap development dimulai. Revisi tambahan dapat dikerjakan dengan biaya yang sangat terjangkau.', 'category' => 'general', 'sort_order' => 3],
            ['question' => 'Apakah website yang dibuat sudah mobile-friendly?', 'answer' => 'Tentu saja! Semua website yang kami buat 100% responsive dan mobile-friendly. Kami menggunakan teknik desain modern yang memastikan tampilan optimal di semua perangkat: smartphone, tablet, laptop, dan desktop.', 'category' => 'general', 'sort_order' => 4],
            ['question' => 'Apakah HVM Digital bisa melayani klien di luar Surabaya?', 'answer' => 'Ya! HVM Digital melayani klien di seluruh Indonesia secara online. Kami memiliki kantor di Surabaya (HQ) dan Bekasi. Untuk klien luar kota, proses pengerjaan dilakukan secara remote dengan komunikasi via WhatsApp, Zoom, dan email.', 'category' => 'general', 'sort_order' => 5],
            ['question' => 'Apakah sudah termasuk hosting dan domain?', 'answer' => 'Paket kami bisa include hosting dan domain, atau hanya jasa pembuatan saja. Kami menyediakan paket lengkap dengan hosting cepat dan domain .com/.id dengan harga terjangkau. Tanyakan detail paket kepada tim kami via WhatsApp.', 'category' => 'general', 'sort_order' => 6],
            ['question' => 'Bagaimana cara memulai project dengan HVM Digital?', 'answer' => 'Sangat mudah! Hubungi kami via WhatsApp di +62851-7998-2373 untuk konsultasi GRATIS. Tim kami akan membantu menganalisis kebutuhan bisnis Anda dan memberikan penawaran terbaik. Setelah deal, kami akan memulai project dalam 1x24 jam.', 'category' => 'general', 'sort_order' => 7],
            ['question' => 'Apakah ada dukungan after-sales / maintenance?', 'answer' => 'Ya! Kami memberikan garansi support 30 hari setelah website live untuk semua paket. Untuk jangka panjang, tersedia paket maintenance bulanan dengan harga terjangkau yang mencakup: update konten, backup rutin, keamanan, dan monitoring performa.', 'category' => 'general', 'sort_order' => 8],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], array_merge($faq, ['is_active' => true]));
        }

        // === TESTIMONIALS ===
        $testimonials = [
            ['name' => 'Budi Santoso', 'company' => 'CV Mitra Jaya', 'city' => 'Surabaya', 'city_key' => 'surabaya', 'content' => 'HVM Digital benar-benar profesional! Website toko online saya selesai tepat waktu dan hasilnya sangat memuaskan. Penjualan online naik 300% dalam 3 bulan pertama. Sangat rekomendasikan!', 'rating' => 5, 'service_used' => 'Pembuatan Website', 'sort_order' => 1],
            ['name' => 'Siti Rahayu', 'company' => 'Toko Batik Rahayu', 'city' => 'Surabaya', 'city_key' => 'surabaya', 'content' => 'Terima kasih HVM Digital! SEO website kami sekarang sudah halaman 1 Google untuk kata kunci "batik Surabaya". Omset meningkat signifikan sejak menggunakan layanan SEO mereka.', 'rating' => 5, 'service_used' => 'SEO & SEM', 'sort_order' => 2],
            ['name' => 'Ahmad Fauzi', 'company' => 'PT Tekno Mandiri', 'city' => 'Jakarta', 'city_key' => 'jakarta', 'content' => 'Awalnya ragu karena tim HVM ada di Surabaya, tapi komunikasinya sangat baik via WhatsApp dan Zoom. Website company profile kami jadi sangat profesional dan responsive. Worth it banget!', 'rating' => 5, 'service_used' => 'Pembuatan Website', 'sort_order' => 3],
            ['name' => 'Dewi Lestari', 'company' => 'Salon Cantik Dewi', 'city' => 'Bekasi', 'city_key' => 'bekasi', 'content' => 'Paket social media management-nya TOP! Followers Instagram saya dari 500 naik ke 8000 dalam 4 bulan. Konten kreatifnya juga sangat menarik dan engagement-nya tinggi.', 'rating' => 5, 'service_used' => 'Social Media Management', 'sort_order' => 4],
            ['name' => 'Rizki Pratama', 'company' => 'Warung Kopi Rizki', 'city' => 'Malang', 'city_key' => 'malang', 'content' => 'Harganya sangat terjangkau untuk kualitas yang diberikan. Landing page bisnis kopi saya terlihat keren dan profesional. Banyak customer baru yang datang dari Google setelah website live.', 'rating' => 5, 'service_used' => 'Pembuatan Website', 'sort_order' => 5],
            ['name' => 'Kartini Wibowo', 'company' => 'CV Kartini Fashion', 'city' => 'Bandung', 'city_key' => 'bandung', 'content' => 'HVM Digital membantu bisnis fashion saya go digital dengan sempurna. Desain website-nya cantik dan fitur toko online-nya lengkap. Tim-nya sabar dan responsif. 5 bintang!', 'rating' => 5, 'service_used' => 'Pembuatan Website', 'sort_order' => 6],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name'], 'company' => $t['company']], array_merge($t, ['is_active' => true]));
        }
    }
}
