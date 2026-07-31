{{-- ===== PRIVATE CONSULTATION SECTION ===== --}}
<section class="py-16 md:py-20 bg-white dark:bg-[#0a1510]" id="konsultasi-gratis">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                {{-- Left — Visual --}}
                <div class="relative">
                    {{-- Main card --}}
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl"
                         style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);min-height:340px;">
                        <div class="absolute inset-0 opacity-[0.06]"
                             style="background-image:linear-gradient(rgba(154,203,3,0.5) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.5) 1px,transparent 1px);background-size:32px 32px;"></div>

                        {{-- Private Discussion badge --}}
                        <div class="absolute top-6 left-6 z-10">
                            <span class="inline-flex items-center gap-2 bg-[#9acb03]/20 border border-[#9acb03]/40 text-[#9acb03] text-xs font-semibold px-4 py-1.5 rounded-full">
                                <span class="w-2 h-2 rounded-full bg-[#9acb03] animate-pulse"></span>
                                Private Discussion
                            </span>
                        </div>

                        <div class="p-8 pt-20 pb-8">
                            {{-- Meeting mode options --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                {{-- Online --}}
                                <div class="bg-white/8 border border-white/15 rounded-2xl p-5 hover:border-[#9acb03]/40 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-9 h-9 rounded-xl bg-[#9acb03]/20 flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-white text-sm">Online</p>
                                            <p class="text-white/40 text-[11px]">WhatsApp · Zoom · Google Meet</p>
                                        </div>
                                    </div>
                                    <p class="text-white/50 text-xs font-light leading-relaxed">Konsultasi kapan saja, dari mana saja — fleksibel dan efisien.</p>
                                </div>
                                {{-- Offline --}}
                                <div class="bg-white/8 border border-white/15 rounded-2xl p-5 hover:border-[#9acb03]/40 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-9 h-9 rounded-xl bg-[#9acb03]/20 flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-white text-sm">Offline</p>
                                            <p class="text-white/40 text-[11px]">Surabaya & sekitarnya</p>
                                        </div>
                                    </div>
                                    <p class="text-white/50 text-xs font-light leading-relaxed">Bertemu langsung di lokasi Anda atau kantor kami di Surabaya.</p>
                                </div>
                            </div>

                            {{-- Free badge --}}
                            <div class="flex items-center justify-between bg-[#9acb03]/10 border border-[#9acb03]/25 rounded-xl px-5 py-3">
                                <div>
                                    <p class="text-white font-semibold text-sm">Sesi Konsultasi Gratis</p>
                                    <p class="text-white/40 text-xs font-light">Durasi 30–60 menit · Tanpa komitmen</p>
                                </div>
                                <span class="text-[#9acb03] font-bold text-xl">GRATIS</span>
                            </div>
                        </div>

                        {{-- Floating user avatars --}}
                        <div class="absolute top-5 right-5 flex -space-x-2">
                            @foreach(['bg-[#075749]','bg-[#0a6d58]','bg-[#9acb03]'] as $bg)
                            <div class="w-8 h-8 rounded-full {{ $bg }} border-2 border-[#053d33] flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                            </div>
                            @endforeach
                            <div class="w-8 h-8 rounded-full bg-[#9acb03]/20 border-2 border-[#053d33] flex items-center justify-center">
                                <span class="text-[#9acb03] text-[9px] font-bold">100+</span>
                            </div>
                        </div>
                    </div>

                    {{-- Decorative glow --}}
                    <div class="absolute -bottom-4 -right-4 w-40 h-40 bg-[#9acb03]/10 rounded-full blur-2xl pointer-events-none"></div>
                </div>

                {{-- Right — Content --}}
                <div>
                    <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-4">Langkah Pertama</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-5 leading-tight">
                        Konsultasi Gratis<br>
                        <span class="text-[#075749] dark:text-[#9acb03]">Tanpa Komitmen, Tanpa Tekanan</span>
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-light leading-relaxed mb-6">
                        Kami percaya bahwa kolaborasi terbaik dimulai dari pemahaman mendalam. Sesi konsultasi kami bukan sekadar presentasi — ini adalah <strong class="text-[#075749] dark:text-[#9acb03] font-medium">diskusi privat</strong> tentang bisnis Anda: tantangan, target pasar, dan solusi digital yang paling efektif.
                    </p>

                    <ul class="space-y-3 mb-8">
                        @foreach(['Analisis kebutuhan digital bisnis Anda secara mendalam','Rekomendasi strategi website yang sesuai budget & target','Estimasi timeline dan harga yang transparan','Konsultasi bisa online (WA/Zoom) maupun offline di Surabaya'] as $item)
                        <li class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full bg-[#9acb03]/20 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-[#9acb03]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            </div>
                            <span class="text-gray-600 dark:text-gray-300 text-sm font-light">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi gratis untuk website bisnis saya di '.$cityConfig['name']) }}"
                       target="_blank" rel="noopener"
                       class="wa-btn inline-flex items-center gap-2.5 font-semibold px-8 py-4 rounded-full text-white hover:scale-105 transition-all shadow-lg"
                       style="background:linear-gradient(135deg,#075749,#9acb03);box-shadow:0 8px 24px rgba(7,87,73,0.25);">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Mulai Konsultasi Gratis Sekarang
                    </a>
                    <p class="text-gray-300 dark:text-gray-600 text-xs mt-3 font-light">
                        Atau hubungi: {{ setting('whatsapp_display', '+62851-7998-2373') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
