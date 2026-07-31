<section class="py-16" style="background: linear-gradient(135deg, #053d33, #075749);">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Alur Kerja</span>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Proses Kerja Kami</h2>
            <p class="text-white/50 font-light text-sm">Transparan, terstruktur, dan berorientasi hasil</p>
        </div>
        @php
        $steps = [
            ['num'=>'01','icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z','title'=>'Desain & Wireframe','desc'=>'Merancang tampilan dan struktur halaman sesuai brand dan target audiens bisnis Anda.'],
            ['num'=>'02','icon'=>'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4','title'=>'Development','desc'=>'Membangun website dengan kode bersih, cepat, mobile-friendly, dan siap SEO sejak hari pertama.'],
            ['num'=>'03','icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','title'=>'Revisi & Testing','desc'=>'Revisi hingga 3x dan testing menyeluruh di semua perangkat — desktop, tablet, dan mobile.'],
            ['num'=>'04','icon'=>'M15 11a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 7-7 13-9 13S3 18 3 11a9 9 0 0118 0z','title'=>'Launch & Support','desc'=>'Website live! Support teknis 30 hari pasca peluncuran dan panduan pengelolaan konten.'],
        ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($steps as $i => $step)
            <div class="relative bg-white/5 border border-white/10 rounded-2xl p-7 hover:bg-white/10 hover:border-[#9acb03]/30 transition-all group">
                {{-- Connector line --}}
                @if($i < count($steps)-1)
                <div class="hidden lg:block absolute top-10 -right-2.5 w-5 h-0.5 bg-[#9acb03]/20 z-10"></div>
                @endif
                <div class="text-5xl font-bold mb-4" style="color:rgba(154,203,3,0.18);">{{ $step['num'] }}</div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background:rgba(154,203,3,0.15);">
                    <svg class="w-5 h-5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $step['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-white mb-2 text-sm">{{ $step['title'] }}</h3>
                <p class="text-white/50 text-xs font-light leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
