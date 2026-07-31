{{-- ===== COCOK DI SEMUA BIDANG USAHA ===== --}}
@php
    $industries = [
        [
            'label' => 'Kuliner & F&B',
            'sub' => 'Restoran, kafe, katering, cloud kitchen',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>'
        ],
        [
            'label' => 'Fashion & Distro',
            'sub' => 'Brand lokal, konveksi, olshop fashion',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>'
        ],
        [
            'label' => 'Kerajinan & Souvenir',
            'sub' => 'Pengrajin, galeri seni, oleh-oleh lokal',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>'
        ],
        [
            'label' => 'Jasa Profesional',
            'sub' => 'Konsultan, notaris, lawyer, akuntan',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'
        ],
        [
            'label' => 'Klinik & Kesehatan',
            'sub' => 'Klinik, apotek, dokter praktik, spa',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>'
        ],
        [
            'label' => 'Pendidikan',
            'sub' => 'Sekolah, bimbel, kursus, lembaga pelatihan',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>'
        ],
        [
            'label' => 'Properti & Developer',
            'sub' => 'Developer, agen properti, kontraktor',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'
        ],
        [
            'label' => 'Otomotif',
            'sub' => 'Bengkel, dealer, accessories, modifikasi',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>'
        ],
        [
            'label' => 'Distributor',
            'sub' => 'Distribusi barang, agen resmi, reseller',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>'
        ],
        [
            'label' => 'Produsen & Pabrik',
            'sub' => 'Manufaktur, pabrik, industri pengolahan',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>'
        ],
        [
            'label' => 'Supplier & Trading',
            'sub' => 'Supplier bahan baku, material, sparepart',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>'
        ],
        [
            'label' => 'Kontraktor',
            'sub' => 'Konstruksi, interior, renovasi, MEP',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'
        ],
        [
            'label' => 'Pertanian & Agro',
            'sub' => 'Petani, eksportir agro, olahan pertanian',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
        ],
        [
            'label' => 'Konveksi & Garmen',
            'sub' => 'Jahit seragam, konveksi massal, bordir',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>'
        ],
        [
            'label' => 'Komunitas',
            'sub' => 'Yayasan, komunitas, organisasi sosial',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'
        ],
        [
            'label' => 'Semua Jenis Usaha',
            'sub' => 'Apapun bidang bisnis Anda, kami siap',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>'
        ],
    ];
@endphp

<section class="py-16 md:py-20 bg-white dark:bg-[#0a1510]" id="bidang-usaha">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Untuk Semua
                Segmen Bisnis</span>
            <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-3">
                Cocok untuk <span class="text-[#075749] dark:text-[#9acb03]">Semua Bidang Usaha</span>
                <span class="block text-sm font-normal text-gray-400 dark:text-gray-500 mt-1">di
                    {{ $cityConfig['name'] }}</span>
            </h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-light max-w-xl mx-auto">
                Dari UMKM hingga korporat — HVM Digital punya solusi website yang tepat untuk setiap jenis bisnis.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 md:gap-4" id="industry-grid">
            @foreach($industries as $industry)
                <div class="industry-card group flex items-start gap-3.5 p-4 md:p-5 rounded-2xl border
                            bg-[#f8fdfb] dark:bg-[#0d1f15]
                            border-[#075749]/10 dark:border-[#9acb03]/10
                            hover:border-[#9acb03]/50 hover:shadow-lg hover:-translate-y-1
                            transition-all duration-300 cursor-default">
                    <div class="w-9 h-9 rounded-xl shrink-0 flex items-center justify-center
                                bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15
                                group-hover:from-[#075749] group-hover:to-[#0a6d58]
                                transition-all duration-300 mt-0.5">
                        <svg style="width:18px;height:18px;flex-shrink:0;"
                            class="text-[#075749] dark:text-[#9acb03] group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            {!! $industry['icon'] !!}
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p
                            class="font-semibold text-[#0a1f12] dark:text-white text-sm leading-snug group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">
                            {{ $industry['label'] }}
                        </p>
                        <p class="text-gray-400 dark:text-gray-500 text-[11px] font-light mt-0.5 leading-snug">
                            {{ $industry['sub'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <p class="text-gray-400 dark:text-gray-500 text-sm mb-4">Tidak menemukan bidang usaha Anda? Kami tetap bisa
                membantu.</p>
            <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi website untuk bisnis saya di ' . $cityConfig['name']) }}"
                target="_blank" rel="noopener" class="wa-btn inline-flex items-center gap-2.5 text-sm font-semibold
                      text-[#075749] dark:text-[#9acb03]
                      border border-[#075749]/30 dark:border-[#9acb03]/30
                      px-7 py-3.5 rounded-full
                      hover:bg-[#075749] hover:text-white hover:border-[#075749]
                      dark:hover:bg-[#9acb03] dark:hover:text-[#053d33]
                      transition-all duration-300">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
                Konsultasi Bidang Bisnis Anda
            </a>
        </div>
    </div>
</section>