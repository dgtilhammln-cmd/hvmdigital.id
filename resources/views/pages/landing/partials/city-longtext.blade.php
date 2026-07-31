{{-- ===== MERGED FAQ — Longtext deep Q&A with old city-faq design ===== --}}
{{-- Menggabungkan city-faq dan city-longtext jadi 1 section dengan desain AlpineJS --}}
@php
$kota     = $cityConfig['name'];
$province = $cityConfig['province'];
$harga    = $profile['harga_mulai'] ?? 'Rp 1 juta';
$area1    = $cityConfig['nearby'][0] ?? $kota;
$area2    = $cityConfig['nearby'][1] ?? $cityConfig['province'];

// Priority: profile-specific FAQs first
$profileFaqs = config("city-profiles.{$city}.faqs", []);
$profileObjs = collect($profileFaqs)->map(fn($f) => (object)['question'=>$f['q'],'answer'=>$f['a']]);

// Deep longtext FAQs — unique per city
$longtextFaqs = collect([
    (object)[
        'question' => "Berapa harga jasa pembuatan website di {$kota}?",
        'answer'   => "Harga website di {$kota} sangat bervariasi tergantung kebutuhan bisnis Anda. HVM Digital menawarkan paket mulai dari Rp 1 juta untuk landing page sederhana, Rp 5 juta untuk website company profile lengkap, hingga Rp 10 juta lebih untuk toko online dengan fitur penuh. Yang membedakan HVM Digital dari vendor website murah di {$kota} lainnya adalah kualitas desain premium, konten teroptimasi Google, dan support teknis pasca-launch. Semua harga sudah termasuk domain, hosting tahun pertama, dan SSL — tidak ada biaya tersembunyi. Konsultasi awal kami lakukan GRATIS, baik via WhatsApp maupun meeting di {$kota}.",
    ],
    (object)[
        'question' => "Apa keuntungan membuat website untuk bisnis di {$kota}?",
        'answer'   => "Bisnis di {$kota} menghadapi persaingan yang makin ketat dari pemain lokal maupun brand nasional. Website profesional memberikan beberapa keunggulan krusial: bisnis terlihat kredibel di mata calon pelanggan {$kota} yang mencari lewat Google, bekerja 24 jam sebagai salesman otomatis, dan menghasilkan traffic organik dari pencarian lokal {$kota} tanpa biaya iklan tambahan. HVM Digital sudah membuktikan ini dengan ratusan klien dari berbagai industri di {$kota} dan {$area1}.",
    ],
    (object)[
        'question' => "Apakah website HVM Digital sudah SEO-friendly untuk pencarian di {$kota}?",
        'answer'   => "Ya — SEO adalah fondasi wajib di setiap project HVM Digital. Setiap website untuk klien {$kota} sudah dilengkapi: meta title dan description spesifik {$kota}, schema markup LocalBusiness dengan GPS akurat, struktur heading H1–H3 yang benar, kecepatan loading di bawah 2 detik, dan sitemap XML otomatis. Ini memastikan Google memahami bahwa bisnis Anda relevan untuk pencarian di {$kota}, {$area1}, {$area2}, dan sekitarnya. Rata-rata klien mulai muncul halaman 1 Google dalam 1–3 bulan.",
    ],
    (object)[
        'question' => "Berapa lama pembuatan website untuk bisnis di {$kota}?",
        'answer'   => "Timeline HVM Digital untuk klien {$kota}: landing page 5–7 hari kerja, company profile (5 halaman) 7–14 hari, toko online 14–21 hari, sistem custom 30–60 hari. Sebelum project mulai, Anda menerima jadwal milestone yang jelas: mockup, development, revisi, dan launch. Kami memberikan laporan progress berkala untuk project jangka panjang.",
    ],
    (object)[
        'question' => "Bagaimana langkah-langkah pembuatan website di HVM Digital?",
        'answer'   => "Proses kerja kami untuk klien {$kota}: (1) Konsultasi Gratis via WhatsApp, Zoom, atau tatap muka. (2) Proposal detail dengan harga, timeline, dan scope kerja jelas. (3) Desain mockup sesuai brand Anda — bisa direvisi sebelum development. (4) Development dengan kode bersih, cepat, mobile-friendly. (5) Revisi gratis hingga 3x. (6) Launch dan training kelola konten mandiri. (7) Support teknis 30 hari pasca-launch.",
    ],
    (object)[
        'question' => "Apakah saya bisa kelola sendiri website yang dibuat HVM Digital?",
        'answer'   => "Tentu. Website kami dilengkapi CMS yang mudah digunakan tanpa pengetahuan teknis — ubah teks, ganti gambar, tambah produk, dan posting artikel secara mandiri. Kami sediakan video tutorial dan dokumentasi tertulis khusus untuk bisnis {$kota} Anda. Urusan teknis seperti update sistem, backup, dan keamanan server kami tangani otomatis sebagai bagian maintenance.",
    ],
    (object)[
        'question' => "Apakah HVM Digital melayani klien {$kota} secara online?",
        'answer'   => "Ya! Seluruh proses — konsultasi, desain, revisi, serah terima — dilakukan via WhatsApp, Zoom, dan Google Meet. Klien {$kota} tidak perlu datang ke Surabaya. Kami juga bisa meeting offline di {$kota} untuk project enterprise dengan perjanjian.",
    ],
]);

// Smart Semantic Deduplicator to avoid duplicate/overlapping intents
$allFaqs = collect();
foreach ($profileObjs as $p) {
    $allFaqs->push($p);
}

foreach ($longtextFaqs as $l) {
    $isDup = false;
    $lLower = strtolower($l->question);
    
    foreach ($allFaqs as $a) {
        $aLower = strtolower($a->question);
        
        // 1. Match Biaya / Harga
        if ((str_contains($lLower, 'harga') || str_contains($lLower, 'biaya')) && (str_contains($aLower, 'harga') || str_contains($aLower, 'biaya'))) {
            $isDup = true;
            break;
        }
        
        // 2. Match Layanan Online / Lokasi / Kantor
        if ((str_contains($lLower, 'online') || str_contains($lLower, 'melayani') || str_contains($lLower, 'kantor')) && 
            (str_contains($aLower, 'online') || str_contains($aLower, 'melayani') || str_contains($aLower, 'kantor'))) {
            $isDup = true;
            break;
        }
        
        // 3. Match Durasi / Waktu / Lama
        if ((str_contains($lLower, 'lama') || str_contains($lLower, 'durasi') || str_contains($lLower, 'waktu')) && 
            (str_contains($aLower, 'lama') || str_contains($aLower, 'durasi') || str_contains($aLower, 'waktu'))) {
            $isDup = true;
            break;
        }
        
        // 4. Match SEO / Google Search
        if ((str_contains($lLower, 'seo') || str_contains($lLower, 'google')) && 
            (str_contains($aLower, 'seo') || str_contains($aLower, 'google'))) {
            $isDup = true;
            break;
        }
    }
    
    if (!$isDup) {
        $allFaqs->push($l);
    }
}
@endphp

@if($allFaqs->count() > 0)
<section class="py-16 md:py-20 bg-[#f0fdf4] dark:bg-[#061009]" x-data="{ open: null }" id="faq">
    <div class="container mx-auto px-4 lg:px-8 max-w-3xl">
        <div class="text-center mb-10">
            <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Pertanyaan Umum</span>
            <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-3">
                FAQ — Jasa Website {{ $kota }}
            </h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-light">
                Pertanyaan yang paling sering ditanyakan calon klien di {{ $kota }} dan {{ $province }}
            </p>
        </div>

        <div class="space-y-3">
            @foreach($allFaqs as $idx => $faq)
            <div class="bg-white dark:bg-[#0d1f15] rounded-2xl border border-[#075749]/10 dark:border-[#9acb03]/10 overflow-hidden hover:border-[#9acb03]/30 transition-colors">
                <button @click="open==={{ $idx }}?open=null:open={{ $idx }}"
                        class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left hover:bg-[#f0fdf4] dark:hover:bg-[#111d16] transition-colors">
                    <span class="font-medium text-[#0a1f12] dark:text-white text-sm leading-snug">
                        {{ $faq->question }}
                    </span>
                    <svg class="w-5 h-5 text-[#075749] dark:text-[#9acb03] shrink-0 transition-transform duration-200"
                         :class="open==={{ $idx }}?'rotate-45':''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
                <div x-show="open==={{ $idx }}" x-transition class="px-6 pb-5">
                    <p class="text-gray-500 dark:text-gray-400 font-light text-sm leading-relaxed">
                        {{ $faq->answer }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-400 text-sm mb-4 font-light">Masih punya pertanyaan lain?</p>
            <a href="{{ wa_link('Halo HVM Digital, saya ingin tanya tentang jasa website di '.$kota) }}"
               target="_blank" rel="noopener"
               class="wa-btn inline-flex items-center gap-2 text-white font-semibold px-6 py-3 rounded-full hover:scale-105 transition-all text-sm"
               style="background:linear-gradient(135deg,#075749,#9acb03);">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                Tanya via WhatsApp
            </a>
        </div>
    </div>
</section>
@endif
