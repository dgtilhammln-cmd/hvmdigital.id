<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name',        'value' => 'HVM Digital',               'group' => 'general', 'type' => 'text',  'label' => 'Nama Situs'],
            ['key' => 'site_tagline',     'value' => 'Digital & IT Solution',      'group' => 'general', 'type' => 'text',  'label' => 'Tagline'],
            ['key' => 'site_slogan',      'value' => 'Growth Your Business With HVM Digital', 'group' => 'general', 'type' => 'text', 'label' => 'Slogan'],
            ['key' => 'site_description', 'value' => 'Agensi One-Stop Solution Digital Marketing & IT Solution berbasis di Surabaya. Kami hadir sebagai pelabuhan bagi ide-ide besar bisnis Anda.', 'group' => 'general', 'type' => 'textarea', 'label' => 'Deskripsi Situs'],
            ['key' => 'site_keywords',    'value' => 'digital marketing surabaya, jasa website surabaya, IT solution, agensi digital, HVM Digital', 'group' => 'general', 'type' => 'text', 'label' => 'Keywords Default'],

            // Contact
            ['key' => 'whatsapp',         'value' => '6285179982373',              'group' => 'contact', 'type' => 'text',  'label' => 'Nomor WhatsApp (tanpa +)'],
            ['key' => 'whatsapp_display', 'value' => '+62851-7998-2373',           'group' => 'contact', 'type' => 'text',  'label' => 'Tampilan WhatsApp'],
            ['key' => 'email',            'value' => 'bisnis@hvm-digital.id',       'group' => 'contact', 'type' => 'text',  'label' => 'Email Bisnis'],
            ['key' => 'instagram',        'value' => 'https://www.instagram.com/hvmdigital.id', 'group' => 'contact', 'type' => 'text', 'label' => 'Instagram URL'],
            ['key' => 'address_surabaya', 'value' => 'Jl. Rungkut Lor VII Dalam, Rungkut, Surabaya, Jawa Timur', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Alamat Surabaya (HQ)'],
            ['key' => 'address_bekasi',   'value' => 'Sentra Bisnis Kota Harapan Indah Blok SS No 11, Bekasi', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Alamat Bekasi'],

            // SEO Homepage
            ['key' => 'home_meta_title',       'value' => 'HVM Digital — Growth Your Business With HVM Digital | Agensi Digital Marketing Surabaya', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title Homepage'],
            ['key' => 'home_meta_description', 'value' => 'HVM Digital adalah agensi One-Stop Solution Digital Marketing & IT Solution di Surabaya. Website, SEO, Iklan Digital, dan Aplikasi Custom untuk bisnis Anda. #MeroketWithHVM', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description Homepage'],
            ['key' => 'home_meta_keywords',    'value' => 'digital marketing surabaya, jasa website surabaya, IT solution, agensi digital surabaya, HVM Digital, jasa SEO surabaya', 'group' => 'seo', 'type' => 'text', 'label' => 'Keywords Homepage'],

            // SEO About
            ['key' => 'about_meta_title',       'value' => 'Tentang Kami — HVM Digital | Agensi IT Solution Surabaya', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title Tentang Kami'],
            ['key' => 'about_meta_description', 'value' => 'Pelajari lebih lanjut tentang tim di balik HVM Digital, visi kami untuk mentransformasi UMKM, dan layanan IT Solution kami.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description Tentang Kami'],
            ['key' => 'about_meta_keywords',    'value' => 'tentang hvm digital, profil perusahaan it, tim hvm digital surabaya', 'group' => 'seo', 'type' => 'text', 'label' => 'Keywords Tentang Kami'],

            // SEO Services
            ['key' => 'services_meta_title',       'value' => 'Layanan Kami — HVM Digital | Pembuatan Website & Digital Marketing', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title Layanan'],
            ['key' => 'services_meta_description', 'value' => 'Kami menyediakan jasa pembuatan website profesional, optimasi SEO, manajemen sosial media, dan aplikasi custom di Surabaya.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description Layanan'],
            ['key' => 'services_meta_keywords',    'value' => 'jasa website surabaya, layanan seo, social media management, jasa aplikasi custom', 'group' => 'seo', 'type' => 'text', 'label' => 'Keywords Layanan'],

            // SEO Portfolio
            ['key' => 'portfolio_meta_title',       'value' => 'Portfolio Klien — HVM Digital | Bukti Nyata Hasil Kerja Kami', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title Portfolio'],
            ['key' => 'portfolio_meta_description', 'value' => 'Lihat berbagai proyek sukses yang telah kami selesaikan, mulai dari website e-commerce hingga aplikasi korporat.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description Portfolio'],
            ['key' => 'portfolio_meta_keywords',    'value' => 'portfolio website, contoh website perusahaan, hasil kerja hvm digital', 'group' => 'seo', 'type' => 'text', 'label' => 'Keywords Portfolio'],

            // SEO Articles
            ['key' => 'articles_meta_title',       'value' => 'Blog & Insight — HVM Digital | Tips Digital Marketing', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title Artikel'],
            ['key' => 'articles_meta_description', 'value' => 'Kumpulan artikel edukatif, insight terbaru seputar digital marketing, teknologi, dan panduan optimasi bisnis.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description Artikel'],
            ['key' => 'articles_meta_keywords',    'value' => 'blog digital marketing, tips bisnis online, artikel teknologi, berita it', 'group' => 'seo', 'type' => 'text', 'label' => 'Keywords Artikel'],

            // SEO Contact
            ['key' => 'contact_meta_title',       'value' => 'Hubungi Kami — HVM Digital | Konsultasi Gratis Sekarang', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title Kontak'],
            ['key' => 'contact_meta_description', 'value' => 'Punya proyek IT atau butuh konsultasi pemasaran digital? Hubungi HVM Digital hari ini juga.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description Kontak'],
            ['key' => 'contact_meta_keywords',    'value' => 'hubungi hvm digital, alamat hvm surabaya, konsultasi website gratis', 'group' => 'seo', 'type' => 'text', 'label' => 'Keywords Kontak'],

            // Social
            ['key' => 'wa_message_default', 'value' => 'Halo HVM Digital, saya ingin konsultasi mengenai layanan digital marketing', 'group' => 'social', 'type' => 'textarea', 'label' => 'Pesan WA Default'],
            ['key' => 'wa_message_website',  'value' => 'Halo HVM Digital, saya ingin konsultasi pembuatan website untuk bisnis saya', 'group' => 'social', 'type' => 'textarea', 'label' => 'Pesan WA Jasa Website'],

            // Appearance
            ['key' => 'logo',              'value' => '',  'group' => 'appearance', 'type' => 'image', 'label' => 'Logo Utama'],
            ['key' => 'logo_white',        'value' => '',  'group' => 'appearance', 'type' => 'image', 'label' => 'Logo Putih (untuk background gelap)'],
            ['key' => 'favicon',           'value' => '',  'group' => 'appearance', 'type' => 'image', 'label' => 'Favicon'],
            ['key' => 'og_image_default',  'value' => '',  'group' => 'appearance', 'type' => 'image', 'label' => 'OG Image Default (1200x630)'],

            // Analytics (Angka yang Bicara)
            ['key' => 'stat_businesses_count',  'value' => '100',  'group' => 'analytics', 'type' => 'text', 'label' => 'Jumlah Bisnis Bergabung'],
            ['key' => 'stat_experience_years',  'value' => '5',    'group' => 'analytics', 'type' => 'text', 'label' => 'Tahun Pengalaman'],
            ['key' => 'stat_satisfaction_rate', 'value' => '4.9',  'group' => 'analytics', 'type' => 'text', 'label' => 'Rating Kepuasan (/5)'],
            ['key' => 'stat_cities_count',      'value' => '15',   'group' => 'analytics', 'type' => 'text', 'label' => 'Jumlah Kota Dilayani'],
            ['key' => 'gtm_id',                 'value' => '',     'group' => 'analytics', 'type' => 'text', 'label' => 'Google Tag Manager ID (GTM-XXXXXXX)'],
            ['key' => 'meta_pixel_id',          'value' => '',     'group' => 'analytics', 'type' => 'text', 'label' => 'Meta Pixel ID'],

            // Agents (WhatsApp CS)
            ['key' => 'cs_agent_1_name',   'value' => 'Fikri — Sales HVM',               'group' => 'agents', 'type' => 'text',  'label' => 'CS Agent 1 Name'],
            ['key' => 'cs_agent_1_role',   'value' => 'Konsultasi Website & Harga',      'group' => 'agents', 'type' => 'text',  'label' => 'CS Agent 1 Role'],
            ['key' => 'cs_agent_1_wa',     'value' => '6285179982373',                   'group' => 'agents', 'type' => 'text',  'label' => 'CS Agent 1 WhatsApp'],
            ['key' => 'cs_agent_1_avatar', 'value' => '',                                'group' => 'agents', 'type' => 'image', 'label' => 'CS Agent 1 Foto/Avatar'],
            ['key' => 'cs_agent_2_name',   'value' => 'Reza — Project Manager',          'group' => 'agents', 'type' => 'text',  'label' => 'CS Agent 2 Name'],
            ['key' => 'cs_agent_2_role',   'value' => 'Teknis, Timeline & Progress',     'group' => 'agents', 'type' => 'text',  'label' => 'CS Agent 2 Role'],
            ['key' => 'cs_agent_2_wa',     'value' => '6285179982373',                   'group' => 'agents', 'type' => 'text',  'label' => 'CS Agent 2 WhatsApp'],
            ['key' => 'cs_agent_2_avatar', 'value' => '',                                'group' => 'agents', 'type' => 'image', 'label' => 'CS Agent 2 Foto/Avatar'],

            // Page Photos (uploadable via admin)
            ['key' => 'hero_image',        'value' => '',  'group' => 'photos', 'type' => 'image', 'label' => 'Foto Hero Section Utama'],
            ['key' => 'about_image',       'value' => '',  'group' => 'photos', 'type' => 'image', 'label' => 'Foto Tentang Kami (Section About)'],
            ['key' => 'cta_section_image', 'value' => '',  'group' => 'photos', 'type' => 'image', 'label' => 'Foto CTA Section (#MeroketWithHVM)'],

            // Client Logos — slot 1–8 (logo image + alt text)
            ['key' => 'client_1_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 1 — Logo'],
            ['key' => 'client_1_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 1 — Alt Text (SEO)'],
            ['key' => 'client_2_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 2 — Logo'],
            ['key' => 'client_2_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 2 — Alt Text (SEO)'],
            ['key' => 'client_3_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 3 — Logo'],
            ['key' => 'client_3_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 3 — Alt Text (SEO)'],
            ['key' => 'client_4_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 4 — Logo'],
            ['key' => 'client_4_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 4 — Alt Text (SEO)'],
            ['key' => 'client_5_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 5 — Logo'],
            ['key' => 'client_5_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 5 — Alt Text (SEO)'],
            ['key' => 'client_6_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 6 — Logo'],
            ['key' => 'client_6_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 6 — Alt Text (SEO)'],
            ['key' => 'client_7_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 7 — Logo'],
            ['key' => 'client_7_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 7 — Alt Text (SEO)'],
            ['key' => 'client_8_logo', 'value' => '', 'group' => 'clients', 'type' => 'image', 'label' => 'Klien 8 — Logo'],
            ['key' => 'client_8_alt',  'value' => 'Klien HVM Digital', 'group' => 'clients', 'type' => 'text',  'label' => 'Klien 8 — Alt Text (SEO)'],

            // Media Mentions — slot 1–5 (logo image + alt text + direct link)
            ['key' => 'mention_1_logo', 'value' => '', 'group' => 'mentions', 'type' => 'image', 'label' => 'Media 1 — Logo'],
            ['key' => 'mention_1_alt',  'value' => 'HVM Digital Diliput Media', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 1 — Alt Text (SEO)'],
            ['key' => 'mention_1_link', 'value' => '#', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 1 — Link URL'],
            ['key' => 'mention_2_logo', 'value' => '', 'group' => 'mentions', 'type' => 'image', 'label' => 'Media 2 — Logo'],
            ['key' => 'mention_2_alt',  'value' => 'HVM Digital Diliput Media', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 2 — Alt Text (SEO)'],
            ['key' => 'mention_2_link', 'value' => '#', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 2 — Link URL'],
            ['key' => 'mention_3_logo', 'value' => '', 'group' => 'mentions', 'type' => 'image', 'label' => 'Media 3 — Logo'],
            ['key' => 'mention_3_alt',  'value' => 'HVM Digital Diliput Media', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 3 — Alt Text (SEO)'],
            ['key' => 'mention_3_link', 'value' => '#', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 3 — Link URL'],
            ['key' => 'mention_4_logo', 'value' => '', 'group' => 'mentions', 'type' => 'image', 'label' => 'Media 4 — Logo'],
            ['key' => 'mention_4_alt',  'value' => 'HVM Digital Diliput Media', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 4 — Alt Text (SEO)'],
            ['key' => 'mention_4_link', 'value' => '#', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 4 — Link URL'],
            ['key' => 'mention_5_logo', 'value' => '', 'group' => 'mentions', 'type' => 'image', 'label' => 'Media 5 — Logo'],
            ['key' => 'mention_5_alt',  'value' => 'HVM Digital Diliput Media', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 5 — Alt Text (SEO)'],
            ['key' => 'mention_5_link', 'value' => '#', 'group' => 'mentions', 'type' => 'text', 'label' => 'Media 5 — Link URL'],

            // Instagram Feeds — slot 1–4 (image + alt text + direct link)
            ['key' => 'feed_1_image', 'value' => '', 'group' => 'feeds', 'type' => 'image', 'label' => 'Instagram Feed 1 — Gambar (3375x4219)'],
            ['key' => 'feed_1_alt',   'value' => 'Desain Feed Instagram HVM Digital 1', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 1 — Alt Text (SEO)'],
            ['key' => 'feed_1_link',  'value' => 'https://www.instagram.com/hvmdigital.id', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 1 — Link URL'],
            ['key' => 'feed_2_image', 'value' => '', 'group' => 'feeds', 'type' => 'image', 'label' => 'Instagram Feed 2 — Gambar (3375x4219)'],
            ['key' => 'feed_2_alt',   'value' => 'Desain Feed Instagram HVM Digital 2', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 2 — Alt Text (SEO)'],
            ['key' => 'feed_2_link',  'value' => 'https://www.instagram.com/hvmdigital.id', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 2 — Link URL'],
            ['key' => 'feed_3_image', 'value' => '', 'group' => 'feeds', 'type' => 'image', 'label' => 'Instagram Feed 3 — Gambar (3375x4219)'],
            ['key' => 'feed_3_alt',   'value' => 'Desain Feed Instagram HVM Digital 3', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 3 — Alt Text (SEO)'],
            ['key' => 'feed_3_link',  'value' => 'https://www.instagram.com/hvmdigital.id', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 3 — Link URL'],
            ['key' => 'feed_4_image', 'value' => '', 'group' => 'feeds', 'type' => 'image', 'label' => 'Instagram Feed 4 — Gambar (3375x4219)'],
            ['key' => 'feed_4_alt',   'value' => 'Desain Feed Instagram HVM Digital 4', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 4 — Alt Text (SEO)'],
            ['key' => 'feed_4_link',  'value' => 'https://www.instagram.com/hvmdigital.id', 'group' => 'feeds', 'type' => 'text', 'label' => 'Instagram Feed 4 — Link URL'],

            // Payment Gateway (Midtrans)
            ['key' => 'midtrans_server_key',  'value' => '', 'group' => 'payment', 'type' => 'text', 'label' => 'Midtrans Server Key'],
            ['key' => 'midtrans_client_key',  'value' => '', 'group' => 'payment', 'type' => 'text', 'label' => 'Midtrans Client Key'],
            ['key' => 'midtrans_merchant_id', 'value' => '', 'group' => 'payment', 'type' => 'text', 'label' => 'Midtrans Merchant ID'],
            ['key' => 'midtrans_environment', 'value' => 'sandbox', 'group' => 'payment', 'type' => 'text', 'label' => 'Environment (sandbox / production)'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
