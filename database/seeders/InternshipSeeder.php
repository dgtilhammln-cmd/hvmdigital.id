<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Internship;

class InternshipSeeder extends Seeder
{
    public function run(): void
    {
        Internship::create([
            'title' => 'Business Development Intern',
            'division' => 'Business & Strategy',
            'location' => 'Surabaya / Remote',
            'duration' => '3 Bulan',
            'qualifications' => '<ul><li>Mahasiswa tingkat akhir atau fresh graduate.</li><li>Memiliki kemampuan komunikasi dan negosiasi yang baik.</li><li>Tertarik dengan dunia digital marketing dan IT solution.</li><li>Bisa bekerja sama dalam tim.</li></ul>',
            'jobdesc' => '<ul><li>Mencari dan menganalisis prospek klien baru.</li><li>Membantu menyusun proposal penawaran layanan.</li><li>Membangun hubungan baik dengan mitra dan klien.</li><li>Mendukung tim sales dalam mencapai target perusahaan.</li></ul>',
            'is_active' => true,
            'sort_order' => 1
        ]);
        
        Internship::create([
            'title' => 'Social Media Specialist Intern',
            'division' => 'Creative Marketing',
            'location' => 'Surabaya / WFO',
            'duration' => '3 Bulan',
            'qualifications' => '<ul><li>Mahasiswa jurusan Ilmu Komunikasi, DKV, atau terkait.</li><li>Aktif menggunakan media sosial (Instagram, TikTok, LinkedIn).</li><li>Kreatif dan selalu up-to-date dengan tren terbaru.</li><li>Mampu membuat copywriting yang menarik.</li></ul>',
            'jobdesc' => '<ul><li>Membuat content plan bulanan untuk media sosial klien.</li><li>Menulis caption dan script video pendek (Reels/TikTok).</li><li>Berinteraksi dengan audiens dan membangun engagement.</li><li>Menganalisis performa konten media sosial.</li></ul>',
            'is_active' => true,
            'sort_order' => 2
        ]);
        
        Internship::create([
            'title' => 'Digital Marketing Intern',
            'division' => 'Performance Marketing',
            'location' => 'Remote / WFH',
            'duration' => '3 - 6 Bulan',
            'qualifications' => '<ul><li>Memahami dasar-dasar digital marketing (SEO, SEM, Social Media Ads).</li><li>Mampu menganalisis data dasar.</li><li>Terbiasa menggunakan tools analitik (contoh: Google Analytics).</li><li>Mau belajar hal-hal teknis baru dengan cepat.</li></ul>',
            'jobdesc' => '<ul><li>Membantu setup dan optimasi campaign iklan digital (Meta Ads, Google Ads).</li><li>Melakukan riset keyword untuk keperluan SEO.</li><li>Menyusun laporan performa campaign mingguan/bulanan.</li><li>Berkolaborasi dengan tim kreatif untuk materi iklan.</li></ul>',
            'is_active' => true,
            'sort_order' => 3
        ]);
    }
}
