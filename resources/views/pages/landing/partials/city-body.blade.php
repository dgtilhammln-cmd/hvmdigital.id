{{--
    city-body.blade.php
    Unique 300–500 kata per kota — anti duplicate content
    Menggunakan config/city-profiles.php
--}}
@php
$profile   = config("city-profiles.{$city}") ?? config('city-profiles.default');
$kota      = $cityConfig['name'];
$provinsi  = $cityConfig['province'];
$industries= $profile['industries'] ?? ['UMKM','Perdagangan','Jasa','Kuliner'];
$kecamatan = $cityConfig['nearby'] ?? [];
@endphp

<section class="py-14 md:py-20 bg-white dark:bg-[#0a1510]" id="tentang">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-5xl mx-auto">

            {{-- Industry pills --}}
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($industries as $ind)
                <span class="inline-flex items-center gap-1.5 bg-[#f0fdf4] dark:bg-[#111d16] border border-[#075749]/15 dark:border-[#9acb03]/20 text-[#075749] dark:text-[#9acb03] text-[11px] font-medium px-3 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 bg-[#9acb03] rounded-full"></span>{{ $ind }}
                </span>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                {{-- Main body text --}}
                <div class="lg:col-span-2">
                    <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-5">
                        Kenapa Bisnis di {{ $kota }} Butuh Website Profesional?
                    </h2>

                    <div class="prose-hvm space-y-4 text-sm md:text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                        @if(!empty($profile['body']))
                            <p>{{ $profile['body'] }}</p>
                        @else
                            @php
                            // Safe context: avoid "Bali adalah pusat ekonomi penting di Bali"
                            $konteks = ($kota === $provinsi) ? "Provinsi {$provinsi}" : "{$kota}, {$provinsi}";
                            $industri3 = implode(', ', array_slice($industries, 0, 3));
                            @endphp
                            <p>Persaingan bisnis di <strong class="text-[#075749] dark:text-[#9acb03]">{{ $kota }}</strong> semakin ketat — dan semakin banyak konsumen yang memulai perjalanan pembelian mereka dari pencarian di Google. Bisnis yang belum memiliki kehadiran digital yang kuat berisiko kehilangan pelanggan kepada kompetitor yang sudah lebih siap secara online.</p>
                            <p>HVM Digital hadir untuk membantu bisnis Anda di {{ $kota }} tampil profesional dan ditemukan oleh calon pelanggan yang tepat. Setiap website yang kami bangun dirancang dengan mempertimbangkan karakteristik pasar lokal {{ $konteks }} — dari perilaku konsumen, industri dominan, hingga kata kunci pencarian yang paling relevan di wilayah ini.</p>
                            <p>Di {{ $kota }}, sektor seperti <strong class="text-[#075749] dark:text-[#9acb03]">{{ $industri3 }}</strong> menjadi tulang punggung ekonomi lokal. Website yang kami kerjakan dirancang khusus untuk memenuhi kebutuhan bisnis di sektor-sektor ini — dengan fitur, desain, dan strategi SEO yang benar-benar relevan untuk pasar {{ $kota }}.</p>
                            <p>Selain itu, setiap website yang kami bangun untuk klien {{ $kota }} memenuhi standar teknis terkini: <em>mobile-first</em> (karena &gt;70% pengguna internet Indonesia mengakses via smartphone), kecepatan loading optimal, dan struktur SEO yang membantu Google memahami relevansi bisnis Anda untuk pencarian lokal di {{ $kota }} dan sekitarnya.</p>
                        @endif

                        {{-- Tagline section (Premium Glassmorphism Quote Box supporting Light & Dark Mode) --}}
                        <div class="mt-8 relative overflow-hidden rounded-3xl p-6 md:p-8 bg-[#f0fdf4] dark:bg-[#0d1f15] border border-[#075749]/15 dark:border-[#9acb03]/20 shadow-xl transition-all duration-300 hover:shadow-2xl hover:border-[#9acb03]/40">
                            {{-- Decorative glow --}}
                            <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#9acb03]/10 dark:bg-[#9acb03]/15 rounded-full blur-2xl pointer-events-none"></div>
                            <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-[#075749]/10 dark:bg-[#075749]/20 rounded-full blur-2xl pointer-events-none"></div>

                            {{-- Quote Icon Header --}}
                            <div class="relative flex items-start gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#075749]/10 dark:bg-[#9acb03]/15 flex items-center justify-center shrink-0 border border-[#075749]/20 dark:border-[#9acb03]/30 shadow-inner">
                                    <svg class="w-5 h-5 text-[#075749] dark:text-[#9acb03]" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.999v10h-9.999z"/></svg>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="text-[#0a1f12] dark:text-white font-semibold text-base md:text-lg leading-relaxed tracking-wide mb-3">
                                        "{{ $profile['tagline'] ?? 'Kota dengan potensi bisnis digital yang terus berkembang' }}"
                                    </p>
                                    <div class="flex items-center gap-2">
                                        <div class="w-4 h-px bg-[#075749]/30 dark:bg-[#9acb03]/50"></div>
                                        <p class="text-[#075749]/70 dark:text-[#9acb03]/80 text-xs font-medium uppercase tracking-wider">Profil pasar {{ $kota }}, {{ $provinsi }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Side stats + area pills --}}
                <div class="space-y-6">
                    {{-- Stats --}}
                    <div class="bg-[#f0fdf4] dark:bg-[#0d1f15] rounded-2xl p-6 border border-[#075749]/10 dark:border-[#9acb03]/10">
                        <h3 class="text-[#075749] dark:text-[#9acb03] font-semibold text-xs uppercase tracking-widest mb-4">Keunggulan Project {{ $kota }}</h3>
                        @foreach([
                            ['Support 1 Tahun Penuh','Garansi tanpa biaya tambahan'],
                            ['SEO Lokal '.$kota,'Dioptimasi untuk pencarian lokal'],
                            ['Free Revisi','Sampai Anda benar-benar puas'],
                            ['Mobile Friendly','Sempurna di semua perangkat'],
                            ['Konsultasi Gratis','Sebelum & sesudah project'],
                        ] as [$title,$sub])
                        <div class="flex items-start gap-3 py-2.5 border-b border-[#075749]/5 dark:border-[#9acb03]/5 last:border-0">
                            <svg class="w-4 h-4 text-[#9acb03] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <div>
                                <p class="text-[#0a1f12] dark:text-white text-xs font-semibold">{{ $title }}</p>
                                <p class="text-gray-400 dark:text-gray-500 text-[11px] font-light">{{ $sub }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Area layanan --}}
                    @if(count($kecamatan) > 0)
                    <div class="bg-[#f0fdf4] dark:bg-[#0d1f15] rounded-2xl p-5 border border-[#075749]/10 dark:border-[#9acb03]/10">
                        <h3 class="text-[#075749] dark:text-[#9acb03] font-semibold text-xs uppercase tracking-widest mb-3">Area Layanan di {{ $kota }}</h3>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($kecamatan as $area)
                            <span class="text-[10px] text-gray-500 dark:text-gray-400 bg-white dark:bg-[#1a2e1e] border border-[#075749]/10 dark:border-[#9acb03]/10 px-2.5 py-1 rounded-full">{{ $area }}</span>
                            @endforeach
                        </div>
                        <p class="text-[10px] text-gray-400 dark:text-gray-500 font-light mt-3 leading-relaxed">
                            HVM Digital melayani bisnis di seluruh kecamatan {{ $kota }} dan wilayah sekitarnya di {{ $provinsi }}.
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
