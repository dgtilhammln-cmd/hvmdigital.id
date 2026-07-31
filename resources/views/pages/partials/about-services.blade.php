{{-- About Us + Services --}}

{{-- About Us section removed as requested --}}

{{-- === OUR SERVICES === --}}
<section class="py-24 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#9acb03] mb-4">Apa yang Kami Tawarkan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white mb-4">Agensi Digital Marketing & Website</h2>
            <p class="text-[#3a6b5d] dark:text-white/50 font-light max-w-xl mx-auto">Solusi digital lengkap dari satu pintu — desain, development, pemasaran, hingga analitik.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <a href="{{ route('services.show', $service->slug) }}"
               class="group bg-white dark:bg-[#0d1f15] rounded-2xl p-8 border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/40 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-all duration-300 shadow-md shadow-[#075749]/20"
                     style="background: linear-gradient(135deg, #075749 0%, #9acb03 100%);">
                    @switch($service->icon)
                        @case('globe')
                        <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        @break
                        @case('search')
                        <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        @break
                        @case('share')
                        <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        @break
                        @case('palette')
                        <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                        @break
                        @case('megaphone')
                        <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                        @break
                        @default
                        <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    @endswitch
                </div>
                <h3 class="font-semibold text-[#0a1f12] dark:text-white text-lg mb-3 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ $service->name }}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light leading-relaxed mb-4">{{ $service->short_description }}</p>
                <div class="flex items-center gap-1 text-[#075749] dark:text-[#9acb03] text-sm font-medium">
                    <span>Pelajari lebih lanjut</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('services') }}" class="inline-flex items-center gap-2 font-medium border-b-2 border-[#9acb03] pb-1 text-[#075749] dark:text-[#9acb03] hover:opacity-80 transition-opacity">
                Lihat Semua Layanan
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
