<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            // ═══════════════════════════════════════════════════════
            // GROUP 1 — TOPIK KONTEN DIGITAL
            // ═══════════════════════════════════════════════════════
            [
                'name'  => 'Digital Marketing',
                'color' => '#075749',
                'children' => [
                    'Website',
                    'SEO & GEO',
                    'Google Ads (SEM)',
                    'Meta Ads',
                    'Social Media Marketing',
                    'Email Marketing',
                    'Content Marketing',
                ],
            ],
            [
                'name'  => 'Artificial Intelligence',
                'color' => '#6366f1',
                'children' => [
                    'AI Chatbot & Virtual Assistant',
                    'AI untuk Bisnis & Otomasi',
                    'Generative AI (teks, gambar, video)',
                    'Robot & Humanoid',
                    'AI dalam SEO & Marketing',
                ],
            ],
            [
                'name'  => 'Bisnis Lokal & UMKM',
                'color' => '#f59e0b',
                'children' => [
                    'Go Online untuk UMKM',
                    'Tips jualan online',
                    'Studi kasus klien HVM Digital',
                    'Marketplace vs website sendiri',
                    'Branding untuk bisnis kecil',
                ],
            ],
            [
                'name'  => 'Desain & UI/UX',
                'color' => '#ec4899',
                'children' => [
                    'Prinsip desain website modern',
                    'UX & konversi',
                    'Desain grafis untuk marketing',
                    'Tren desain website',
                ],
            ],
            [
                'name'  => 'Teknologi & Pengembangan',
                'color' => '#3b82f6',
                'children' => [
                    'Aplikasi web & mobile',
                    'Keamanan website',
                    'Hosting & domain',
                    'WordPress & CMS',
                    'Performa & kecepatan website',
                ],
            ],
            [
                'name'  => 'Tren & Industri Digital',
                'color' => '#8b5cf6',
                'children' => [
                    'Tren digital marketing Indonesia',
                    'Update algoritma Google',
                    'Perkembangan platform sosial',
                    'E-commerce & marketplace',
                    'Startup & ekosistem digital',
                ],
            ],
            [
                'name'  => 'Panduan & Tutorial',
                'color' => '#10b981',
                'children' => [
                    'Tutorial Google Analytics & Search Console',
                    'Panduan setup iklan Google & Meta',
                    'Cara riset keyword',
                    'Tips copywriting & penulisan konten',
                    'Panduan pemula go digital',
                ],
            ],

            // ═══════════════════════════════════════════════════════
            // GROUP 2 — TARGET INDUSTRI / SEGMEN BISNIS
            // ═══════════════════════════════════════════════════════
            [
                'name'  => 'UMKM & Usaha Kecil',
                'color' => '#f97316',
                'children' => [
                    'Warung & toko kelontong',
                    'Pedagang pasar & kaki lima',
                    'Usaha rumahan (home business)',
                    'Pengrajin & handmade',
                    'Laundry & jasa kebersihan',
                    'Bengkel kecil & tambal ban',
                    'Usaha katering rumahan',
                    'Tukang & jasa bangunan ringan',
                ],
            ],
            [
                'name'  => 'Produsen & Manufaktur',
                'color' => '#64748b',
                'children' => [
                    'Pabrik skala kecil & menengah',
                    'Produsen makanan & minuman (FMCG)',
                    'Produsen fashion & konveksi',
                    'Produsen furnitur & meubel',
                    'Produsen spare part & komponen',
                    'Produsen kosmetik & skincare lokal',
                    'Produsen alat pertanian & industri',
                    'Pengolahan hasil laut & pertanian',
                ],
            ],
            [
                'name'  => 'Distributor & Trader',
                'color' => '#0891b2',
                'children' => [
                    'Distributor sembako & bahan pokok',
                    'Distributor elektronik & gadget',
                    'Agen & sub-agen produk FMCG',
                    'Trading bahan baku industri',
                    'Importir & eksportir',
                    'Distributor alat kesehatan',
                    'Distributor bahan bangunan',
                ],
            ],
            [
                'name'  => 'Kuliner & F&B',
                'color' => '#dc2626',
                'children' => [
                    'Restoran & rumah makan',
                    'Kafe & coffee shop',
                    'Cloud kitchen & ghost kitchen',
                    'Katering pernikahan & kantor',
                    'Franchise & waralaba F&B',
                    'Bakery & pastry shop',
                    'Minuman kekinian (boba, es dll)',
                    'Jasa boga & meal prep',
                ],
            ],
            [
                'name'  => 'Kesehatan & Kecantikan',
                'color' => '#db2777',
                'children' => [
                    'Klinik umum & dokter praktik',
                    'Klinik kecantikan & estetika',
                    'Apotek & toko obat',
                    'Salon & barbershop',
                    'Spa & wellness center',
                    'Fisioterapi & klinik khusus',
                    'Toko alat kesehatan',
                    'Skincare brand lokal',
                ],
            ],
            [
                'name'  => 'Properti & Konstruksi',
                'color' => '#92400e',
                'children' => [
                    'Developer perumahan & apartemen',
                    'Agen properti & broker',
                    'Kontraktor bangunan',
                    'Interior designer & dekorator',
                    'Jasa renovasi rumah',
                    'Toko material bangunan',
                    'Jasa arsitek',
                    'Properti komersial & ruko',
                ],
            ],
            [
                'name'  => 'Pendidikan & Pelatihan',
                'color' => '#7c3aed',
                'children' => [
                    'Bimbingan belajar (bimbel)',
                    'Kursus & lembaga pelatihan',
                    'Sekolah swasta & TK',
                    'Kursus bahasa asing',
                    'Pelatihan vokasi & skill digital',
                    'Pesantren & lembaga keagamaan',
                    'Les privat & tutor online',
                ],
            ],
            [
                'name'  => 'Jasa Profesional & Konsultan',
                'color' => '#0f766e',
                'children' => [
                    'Konsultan bisnis & manajemen',
                    'Konsultan pajak & akuntan',
                    'Notaris & pengacara',
                    'HR & rekrutmen',
                    'Konsultan IT & teknologi',
                    'Jasa audit & keuangan',
                    'Event organizer & MICE',
                    'Jasa fotografi & videografi',
                ],
            ],
            [
                'name'  => 'Otomotif & Transportasi',
                'color' => '#1d4ed8',
                'children' => [
                    'Bengkel mobil & motor',
                    'Dealer kendaraan baru & bekas',
                    'Toko aksesori & spare part',
                    'Rental mobil & kendaraan',
                    'Jasa cuci & detailing kendaraan',
                    'Modifikasi & custom kendaraan',
                    'Jasa logistik & ekspedisi',
                ],
            ],
            [
                'name'  => 'Pertanian & Agribisnis',
                'color' => '#15803d',
                'children' => [
                    'Petani & kelompok tani',
                    'Eksportir komoditas pertanian',
                    'Pengolahan hasil tani (agroindustri)',
                    'Peternakan & perikanan',
                    'Toko pertanian & pupuk',
                    'Agrowisata & kebun petik',
                    'Supplier benih & bibit',
                ],
            ],
            [
                'name'  => 'Fashion & Retail',
                'color' => '#be185d',
                'children' => [
                    'Brand fashion lokal',
                    'Toko pakaian & butik',
                    'Konveksi & produksi massal',
                    'Toko sepatu & aksesori',
                    'Olshop fashion',
                    'Distro & streetwear',
                    'Busana muslim & modest wear',
                ],
            ],
            [
                'name'  => 'Pariwisata & Hospitality',
                'color' => '#0369a1',
                'children' => [
                    'Hotel & penginapan',
                    'Villa & homestay',
                    'Agen travel & tour operator',
                    'Wisata kuliner & foodtour',
                    'Fotografer wisata',
                    'Jasa wedding & venue',
                    'Aktivitas & adventure tourism',
                ],
            ],
            [
                'name'  => 'Korporat & Perusahaan Besar',
                'color' => '#374151',
                'children' => [
                    'Perusahaan B2B & tender',
                    'Holding & grup usaha',
                    'Perusahaan ekspor-impor skala besar',
                    'Startup & scaleup',
                    'Fintech & perusahaan keuangan',
                    'Media & penerbitan',
                    'Perusahaan teknologi & SaaS',
                ],
            ],
            [
                'name'  => 'Organisasi & Komunitas',
                'color' => '#854d0e',
                'children' => [
                    'Yayasan & NGO',
                    'Komunitas hobi & minat',
                    'Organisasi keagamaan & masjid',
                    'Koperasi',
                    'Asosiasi profesi & industri',
                    'Lembaga pemerintah & desa',
                ],
            ],
        ];

        $sort = 0;
        foreach ($tree as $parentData) {
            $children = $parentData['children'] ?? [];
            unset($parentData['children']);

            $parent = ArticleCategory::updateOrCreate(
                ['slug' => Str::slug($parentData['name'])],
                array_merge($parentData, [
                    'sort_order' => $sort++,
                    'is_active'  => true,
                ])
            );

            $childSort = 0;
            foreach ($children as $childName) {
                ArticleCategory::updateOrCreate(
                    ['slug' => Str::slug($childName)],
                    [
                        'parent_id'  => $parent->id,
                        'name'       => $childName,
                        'color'      => $parentData['color'],
                        'sort_order' => $childSort++,
                        'is_active'  => true,
                    ]
                );
            }
        }
    }
}
