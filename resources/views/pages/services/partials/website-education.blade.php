{{-- Section 1: Kenapa Bisnis Anda Wajib Memiliki Website (Edukasi) --}}
<section class="py-24 md:py-36 bg-[#f8fafc] dark:bg-[#061009] relative overflow-hidden border-t border-gray-100 dark:border-white/5">
    {{-- Soft decorative backgrounds --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-[0.06] dark:opacity-10 pointer-events-none" style="background: radial-gradient(circle, #075749 0%, transparent 70%);"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#075749] dark:text-[#9acb03] mb-3">Edukasi Bisnis</span>
            <h2 class="text-3xl md:text-5xl font-bold text-[#0a1f12] dark:text-white mb-6 leading-tight">
                Kenapa Bisnis Anda <span class="bg-gradient-to-r from-[#075749] to-[#9acb03] dark:from-[#9acb03] dark:to-[#b8e832] bg-clip-text text-transparent font-extrabold">Wajib Memiliki Website</span>?
            </h2>
            <p class="text-gray-600 dark:text-white/70 text-base md:text-lg font-light leading-relaxed max-w-2xl mx-auto">
                Media sosial saja tidak cukup. Untuk membangun kredibilitas jangka panjang dan menguasai pasar lokal, website resmi berkecepatan tinggi adalah kunci utama pertumbuhan bisnis Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $whyWeb = [
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                    'title' => 'Kredibilitas Instan',
                    'desc' => 'Lebih dari 84% konsumen Indonesia menganggap bisnis dengan website resmi jauh lebih tepercaya dibanding yang hanya berjualan lewat media sosial.'
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'title' => 'Sales Representative 24/7',
                    'desc' => 'Website bekerja non-stop 24 jam sehari mendatangkan prospek baru dan memajang portofolio terbaik Anda, bahkan saat Anda tertidur lelap.'
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>',
                    'title' => 'Aset Digital Mandiri',
                    'desc' => 'Kontrol penuh 100% atas data calon pembeli, branding, dan alur corong konversi tanpa perlu khawatir pada perubahan algoritma media sosial.'
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
                    'title' => 'SEO & Geo-Friendly',
                    'desc' => 'Dirancang dengan teknik arsitektur SEO lokal termodern demi mendominasi mesin pencarian dari kota Anda dan menjangkau target pasar yang tepat.'
                ]
            ];
            @endphp

            @foreach($whyWeb as $item)
            <div class="group bg-white dark:bg-[#0d1f15] border border-gray-200/60 dark:border-white/5 hover:border-[#075749] dark:hover:border-[#9acb03]/40 rounded-2xl p-6 transition-all duration-500 hover:-translate-y-2 shadow-sm dark:shadow-none hover:shadow-lg dark:hover:shadow-[#075749]/10 flex flex-col h-full justify-between">
                <div>
                    {{-- Icon Box with Gradient Background and White Icon Path --}}
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 shadow-md" style="background: linear-gradient(135deg, #075749, #9acb03);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                    </div>
                    <h3 class="text-[#0a1f12] dark:text-white font-bold text-lg mb-3 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ $item['title'] }}</h3>
                    <p class="text-gray-500 dark:text-white/60 text-sm font-light leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Section 2: Pilar Utama Semua Sektor Industri (Industries) --}}
<section class="py-24 md:py-36 bg-white dark:bg-[#0a1510] relative overflow-hidden border-t border-gray-100 dark:border-white/5">
    {{-- Soft decorative backgrounds --}}
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] rounded-full blur-3xl opacity-[0.06] dark:opacity-10 pointer-events-none" style="background: radial-gradient(circle, #9acb03 0%, transparent 70%);"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#075749] dark:text-[#9acb03] mb-3">Segmentasi Pasar</span>
            <h2 class="text-3xl md:text-5xl font-bold text-[#0a1f12] dark:text-white mb-6 leading-tight">
                Pilar Utama <span class="bg-gradient-to-r from-[#075749] to-[#9acb03] dark:from-[#9acb03] dark:to-[#b8e832] bg-clip-text text-transparent font-extrabold">Semua Sektor Industri</span>
            </h2>
            <p class="text-gray-600 dark:text-white/70 text-base md:text-lg font-light leading-relaxed max-w-2xl mx-auto">
                Setiap sektor bisnis memiliki pola konversi unik. Kami merancang arsitektur website yang disesuaikan secara khusus dengan karakter industri Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
            $industries = [
                [
                    'label' => 'B2B & Company Profile',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                    'desc' => 'Website korporat berkelas untuk mengenalkan profil, legalitas, sejarah, portofolio proyek, serta mempermudah negosiasi kerja sama tender.'
                ],
                [
                    'label' => 'Jasa & Kontraktor',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                    'desc' => 'Didesain khusus untuk menampilkan galeri proyek studio arsitek, interior, jasa hukum, medis, maupun keahlian profesional berskala premium.'
                ],
                [
                    'label' => 'Properti & Real Estate',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                    'desc' => 'Tampilkan visual megah hunian, ruko, apartemen dengan spesifikasi lengkap, galeri visual 3D, serta tombol kontak WhatsApp tim marketing.'
                ],
                [
                    'label' => 'Manufaktur & Pabrikasi',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
                    'desc' => 'Showcase katalog produk permesinan, alur rantai produksi, sertifikasi standar mutu ekspor, dan formulir inquiry cepat.'
                ],
                [
                    'label' => 'Klinik, Kuliner & Franchise',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
                    'desc' => 'Tingkatkan kunjungan klinik estetika medis, atau sajikan proyeksi bisnis kemitraan waralaba makanan untuk menggaet investor baru.'
                ],
                [
                    'label' => 'Supplier & Distributor',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 001-1v-4a1 1 0 01.816-.983L18 8.5V11M2 13h10M13 16h3M19 16h1a1 1 0 001-1v-4a1 1 0 00-1-1h-1m-4-7a1 1 0 00-1 1v4h3V4a1 1 0 00-1-1h-1z"/>',
                    'desc' => 'Katalog digital berkapasitas besar untuk memajang stok material, spesifikasi produk grosir, serta tombol kontak tim sales representatif.'
                ]
            ];
            @endphp

            @foreach($industries as $ind)
            <div class="bg-white dark:bg-[#0d1f15] border border-gray-200/60 dark:border-white/5 hover:border-[#075749] dark:hover:border-[#9acb03]/40 rounded-2xl p-7 transition-all duration-300 hover:shadow-lg dark:hover:shadow-[#075749]/10 flex flex-col justify-between h-full">
                <div>
                    {{-- Icon Box with Gradient Background and White Icon Path --}}
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white mb-5 shadow-md" style="background: linear-gradient(135deg, #075749, #9acb03);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $ind['icon'] !!}</svg>
                    </div>
                    <h3 class="text-[#0a1f12] dark:text-white font-bold text-base md:text-lg mb-3">{{ $ind['label'] }}</h3>
                    <p class="text-gray-500 dark:text-white/60 text-xs md:text-sm font-light leading-relaxed">{{ $ind['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Section 3: Alur Pengerjaan Transparan & Terjadwal (Workflow) --}}
<section class="py-24 md:py-36 bg-[#f8fafc] dark:bg-[#061009] relative overflow-hidden border-t border-gray-100 dark:border-white/5">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center mb-20">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#075749] dark:text-[#9acb03] mb-3">Alur Kerja</span>
            <h2 class="text-3xl md:text-5xl font-bold text-[#0a1f12] dark:text-white mb-6 leading-tight">
                Alur Pengerjaan <span class="bg-gradient-to-r from-[#075749] to-[#9acb03] dark:from-[#9acb03] dark:to-[#b8e832] bg-clip-text text-transparent font-extrabold">Transparan & Terjadwal</span>
            </h2>
            <p class="text-gray-600 dark:text-white/70 text-base md:text-lg font-light leading-relaxed max-w-2xl mx-auto">
                Kami menerapkan standardisasi operasional 5 langkah bergaransi demi melahirkan maha karya digital yang optimal untuk mendatangkan profit bagi bisnis Anda.
            </p>
        </div>

        @php
        $steps = [
            [
                'num' => '01',
                'title' => 'Discovery & Konsultasi Strategis',
                'desc' => 'Kami memulai dengan sesi diskusi mendalam untuk membedah target audiens Anda, memetakan kompetitor utama di Google, menyepakati sitemap (struktur halaman), serta menyusun konsep unik landing page/website profile Anda.'
            ],
            [
                'num' => '02',
                'title' => 'Perancangan Visual UI/UX Premium',
                'desc' => 'Desainer UI/UX ahli kami merancang tata letak halaman yang mengutamakan kenyamanan pengguna (user experience) serta estetika visual premium modern yang disesuaikan 100% dengan pedoman identitas brand perusahaan Anda.'
            ],
            [
                'num' => '03',
                'title' => 'Clean-Code Development & Speed Optimization',
                'desc' => 'Tahap coding profesional menggunakan teknologi terkini. Kami memastikan kode bersih (clean-code), loading website secepat kilat (Core Web Vitals optimal), serta arsitektur geo-friendly yang terindeks sempurna di Google.'
            ],
            [
                'num' => '04',
                'title' => 'Quality Control & Lintas Pengujian',
                'desc' => 'Sebelum resmi diluncurkan, website akan melalui serangkaian uji coba ketat mulai dari responsivitas perangkat mobile (smartphone/tablet), kompatibilitas lintas browser, fungsi tautan formulir, serta pengujian celah keamanan.'
            ],
            [
                'num' => '05',
                'title' => 'Peluncuran & Support Pasca Launch',
                'desc' => 'Launching resmi ke server cloud terbaik pilihan Anda. Kerja sama tidak selesai di sini — kami mendampingi Anda dengan memberikan training admin panel, pemantauan performa berkala, serta garansi penanganan eror secara responsif.'
            ]
        ];
        @endphp

        <div class="max-w-3xl mx-auto space-y-12">
            @foreach($steps as $idx => $step)
            <div class="relative flex gap-6 sm:gap-8 group">
                {{-- Left line & dot column — Hidden on small mobile to maximize card text width, auto shows on sm and up --}}
                <div class="hidden sm:flex flex-col items-center shrink-0">
                    {{-- Dot with Gradient Background and White text --}}
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full flex items-center justify-center text-sm font-bold text-white z-10 shadow-md group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, #075749, #9acb03);">
                        {{ $step['num'] }}
                    </div>
                    {{-- Line --}}
                    @if(!$loop->last)
                    <div class="w-0.5 flex-1 bg-gradient-to-b from-[#075749] to-[#9acb03]/40 my-2"></div>
                    @endif
                </div>

                {{-- Right card content column — 100% mobile-friendly with inline badge --}}
                <div class="flex-1 bg-white dark:bg-[#0d1f15] border border-gray-200/60 dark:border-white/5 hover:border-[#075749] dark:hover:border-[#9acb03]/40 p-6 sm:p-8 rounded-2xl shadow-sm dark:shadow-none hover:shadow-lg dark:hover:shadow-[#075749]/10 transition-all duration-300 -mt-1 hover:-translate-y-1">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                        <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-bold tracking-widest uppercase">Langkah {{ $step['num'] }}</span>
                        {{-- Mobile-only badge with Gradient Background --}}
                        <span class="sm:hidden inline-flex items-center justify-center w-7 h-7 rounded-full text-white text-xs font-bold shadow-sm" style="background: linear-gradient(135deg, #075749, #9acb03);">{{ $step['num'] }}</span>
                    </div>
                    <h3 class="text-[#0a1f12] dark:text-white font-bold text-lg sm:text-xl mb-3 leading-snug group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 dark:text-white/60 text-xs sm:text-sm font-light leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
