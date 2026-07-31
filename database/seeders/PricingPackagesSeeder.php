<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPackage;

class PricingPackagesSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Starter',
                'price' => 'Rp 1 Juta',
                'description' => 'Untuk UMKM & usaha rintisan yang butuh kehadiran online cepat.',
                'features' => [
                    '1–3 Halaman Website',
                    'Mobile-Friendly',
                    'Domain .com 1 Tahun',
                    'Hosting SSD 1 Tahun',
                    'SSL Certificate',
                    'Form Kontak WA',
                    'SEO On-Page Dasar',
                    'Selesai 5–7 Hari'
                ],
                'is_popular' => false,
                'button_text' => 'Mulai dengan Starter',
                'wa_message' => 'Halo HVM Digital, saya tertarik paket Starter untuk website',
                'theme_style' => 'starter',
                'order' => 1,
            ],
            [
                'name' => 'Professional',
                'price' => 'Rp 5 Juta',
                'description' => 'Pilihan terbaik bisnis yang ingin tumbuh digital dan generate leads konsisten.',
                'features' => [
                    '5–10 Halaman Website',
                    'Desain Premium Custom',
                    'Domain .com/.id 1 Tahun',
                    'Hosting SSD 5 GB',
                    'SSL + Backup Otomatis',
                    'Blog & CMS Mandiri',
                    'SEO On-Page Lengkap',
                    'Google Analytics 4',
                    'WhatsApp Live Chat',
                    'Revisi 3x Gratis',
                    'Support 30 Hari',
                    'Selesai 10–14 Hari'
                ],
                'is_popular' => true,
                'button_text' => 'Pilih Professional',
                'wa_message' => 'Halo HVM Digital, saya tertarik paket Professional untuk website',
                'theme_style' => 'professional',
                'order' => 2,
            ],
            [
                'name' => 'Enterprise',
                'price' => 'Rp 10 Juta',
                'description' => 'Solusi digital komprehensif untuk perusahaan dan bisnis skala menengah-besar.',
                'features' => [
                    'Halaman Tidak Terbatas',
                    'Toko Online & E-Commerce',
                    'Payment Gateway',
                    'Dashboard Admin Custom',
                    'Multi-bahasa (ID & EN)',
                    'API & Integrasi Sistem',
                    'GTM + Meta Pixel Setup',
                    'Revisi Tanpa Batas',
                    'Support 3 Bulan'
                ],
                'is_popular' => false,
                'button_text' => 'Diskusi Enterprise',
                'wa_message' => 'Halo HVM Digital, saya tertarik paket Enterprise untuk website',
                'theme_style' => 'enterprise',
                'order' => 3,
            ],
            [
                'name' => 'Custom',
                'price' => 'Sesuai Kebutuhan',
                'description' => 'Punya spesifikasi di luar paket? Kami kerjakan 100% sesuai kebutuhan bisnis Anda.',
                'features' => [
                    'Scope Kerja Fleksibel',
                    'Teknologi Bebas Pilih',
                    'Integrasi Sistem Existing',
                    'Aplikasi Web & Mobile',
                    'Maintenance Kontrak',
                    'Dedicated PM',
                    'SLA & Garansi Uptime',
                    'Konsultasi Strategi'
                ],
                'is_popular' => false,
                'button_text' => 'Diskusi Kebutuhan Custom',
                'wa_message' => 'Halo HVM Digital, saya ingin diskusi kebutuhan custom website',
                'theme_style' => 'custom',
                'order' => 4,
            ]
        ];

        PricingPackage::truncate();
        foreach ($packages as $pkg) {
            PricingPackage::create($pkg);
        }
    }
}
