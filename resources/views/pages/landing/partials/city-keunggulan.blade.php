{{-- Keunggulan HVM Digital --}}
<section class="py-24 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#9acb03] mb-4">Mengapa Pilih Kami</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white mb-4">
                Keunggulan Layanan<br>
                <span style="background: linear-gradient(135deg, #075749, #9acb03); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">HVM Digital</span>
            </h2>
            <p class="text-gray-500 dark:text-gray-400 font-light max-w-xl mx-auto">Jasa website &amp; digital marketing yang kami sediakan dirancang untuk benar-benar mengembangkan bisnis Anda — bukan sekadar tampil online.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-16">
            @php
            $kota = $cityConfig['name'];
            $keunggulan = [
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>',
                    'title' => 'One-Stop Digital Solution',
                    'desc' => "Tidak hanya website — klien di {$kota} bisa sekaligus dapat layanan SEO, Google Ads, Meta Ads, desain konten, hingga aplikasi custom dari satu tim.",
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',
                    'title' => 'Website Custom & Kompleks',
                    'desc' => "Selain company profile dan toko online, kami siap bangun sistem custom untuk bisnis {$kota} Anda — dari ERP, CRM, hingga portal industri.",
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>',
                    'title' => 'Banyak Bonus & Free Diskusi',
                    'desc' => "Setiap project sudah termasuk free diskusi private 30 menit, support 30 hari, dan bonus fitur yang dirancang untuk kebutuhan pasar {$kota}.",
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
                    'title' => 'Alur Kerja Transparan',
                    'desc' => "Proses pengerjaan terstruktur dengan milestone yang jelas untuk klien {$kota}. Tidak ada biaya tersembunyi — Anda tahu persis progress setiap saat.",
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>',
                    'title' => 'Harga Fleksibel & Bisa Diskusi',
                    'desc' => "Kami memahami kondisi bisnis di {$kota} beragam. Budget belum cocok? Hubungi kami — tidak ada pressure, kami cari solusi sesuai kemampuan Anda.",
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                    'title' => 'Garansi & Support 1 Tahun',
                    'desc' => "Website Anda di {$kota} sudah live? Tim kami tetap standby 1 tahun pasca-launch untuk memastikan performa optimal tanpa biaya tambahan.",
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                    'title' => 'Dipercaya 200+ Klien',
                    'desc' => "Sejak 2019, HVM Digital telah membantu UMKM, startup, dan perusahaan — termasuk klien dari {$kota} — berkembang digital dengan hasil yang benar-benar terukur.",
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.069A1 1 0 0121 8.871V15.13a1 1 0 01-1.447.9L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>',
                    'title' => 'Konsultasi Online & Tatap Muka',
                    'desc' => "Meski berpusat di Surabaya, kami melayani klien {$kota} via WhatsApp, Zoom, atau Google Meet — atau tatap muka langsung di kantor HVM Digital.",
                ],
            ];
            @endphp

            @foreach($keunggulan as $item)
            <div class="group bg-white dark:bg-[#0d1f15] rounded-2xl p-6 border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/40 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform"
                     style="background: linear-gradient(135deg, rgba(7,87,73,0.12), rgba(154,203,3,0.15));">
                    <svg class="w-5 h-5 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                </div>
                <h3 class="font-semibold text-[#0a1f12] dark:text-white text-sm mb-2 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ $item['title'] }}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-xs font-light leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Free Discussion Images + Portfolio CTA --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            {{-- Image 1: Free Discussion --}}
            <div class="rounded-2xl overflow-hidden shadow-xl aspect-[3054/3818] relative">
                <img src="{{ asset('images/free-discussion.webp') }}"
                     alt="Free Discussion Private 30 Menit - Jasa Website {{ $cityConfig['name'] }} HVM Digital"
                     class="absolute inset-0 w-full h-full object-cover"
                     width="3054" height="3818"
                     loading="lazy">
            </div>

            {{-- Image 2: 30 Menit Ngapain Aja --}}
            <div class="rounded-2xl overflow-hidden shadow-xl aspect-[3054/3818] relative">
                <img src="{{ asset('images/30menit-card.webp') }}"
                     alt="Konsultasi Gratis 30 Menit HVM Digital - Jasa Website {{ $cityConfig['name'] }}"
                     class="absolute inset-0 w-full h-full object-cover"
                     width="3054" height="3818"
                     loading="lazy">
            </div>

            {{-- CTA Card --}}
            <div class="rounded-2xl p-8 flex flex-col justify-center"
                 style="background: linear-gradient(135deg, #075749, #9acb03);">
                <div class="mb-6">
                    <span class="inline-block text-white/70 text-xs font-semibold tracking-widest uppercase mb-3">Siap Mulai?</span>
                    <h3 class="text-2xl font-bold text-white leading-snug mb-3">
                        Lihat Portfolio Kami<br>untuk Bisnis {{ $cityConfig['name'] }}
                    </h3>
                    <p class="text-white/70 font-light text-sm leading-relaxed">
                        Ratusan website profesional telah kami kerjakan. Konsultasi via WA dan lihat portfolio yang relevan untuk industri bisnis Anda di {{ $cityConfig['name'] }}.
                    </p>
                </div>
                <div class="space-y-3">
                    @php $waPortfolio = 'https://wa.me/'.setting('whatsapp','6285179982373').'?text='.urlencode('Halo HVM Digital, saya ingin melihat portfolio website untuk bisnis saya di '.$cityConfig['name']); @endphp
                    <a href="{{ $waPortfolio }}" target="_blank" onclick="trackWaClick('portfolio-cta')"
                       class="wa-btn flex items-center justify-center gap-2.5 bg-white text-[#075749] font-semibold px-6 py-3.5 rounded-full hover:scale-105 hover:shadow-xl transition-all duration-200">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Cek Portfolio via WhatsApp
                    </a>
                    <a href="{{ route('portfolio') }}"
                       class="flex items-center justify-center gap-2 border-2 border-white/50 text-white font-light px-6 py-3 rounded-full hover:border-white hover:bg-white/10 transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Lihat Semua Portfolio
                    </a>
                </div>
                <div class="mt-6 pt-5 border-t border-white/20 flex items-center gap-3">
                    <div class="flex -space-x-2">
                        @foreach(['A','B','C','D'] as $initial)
                        <div class="w-7 h-7 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold" style="background: rgba(7,87,73,0.6);">{{ $initial }}</div>
                        @endforeach
                    </div>
                    <p class="text-white/70 text-xs font-light">200+ klien telah mempercayai kami</p>
                </div>
            </div>
        </div>
    </div>
</section>



