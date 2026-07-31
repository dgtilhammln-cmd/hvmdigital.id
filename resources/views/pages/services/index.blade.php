@extends('layouts.app')

@section('content')

{{-- ===== HERO ===== --}}
<section class="relative pt-40 pb-20 overflow-hidden" style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);">
    <div class="absolute inset-0 opacity-[0.07]" style="background-image:linear-gradient(rgba(154,203,3,0.4) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl pointer-events-none" style="background:radial-gradient(circle,#9acb03,transparent);"></div>
    <div class="relative container mx-auto px-4 lg:px-8 text-center max-w-3xl">
        <nav class="flex items-center justify-center gap-2 text-white/40 text-xs font-light mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#9acb03]">Layanan</span>
        </nav>
        <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-4">One-Stop Digital Solution</span>
        <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-5">
            Layanan Digital<br>
            <span style="background:linear-gradient(135deg,#9acb03,#b8e832);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">HVM Digital</span>
        </h1>
        <p class="text-white/60 text-base md:text-lg font-light leading-relaxed mb-8">Partner pertumbuhan digital bisnis Anda — dari website profesional, SEO, hingga AI automation dalam satu ekosistem terintegrasi.</p>
        <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi layanan') }}" target="_blank" rel="noopener"
           class="w-full sm:w-auto justify-center inline-flex items-center gap-2 font-semibold px-8 py-4 rounded-full text-[#053d33] hover:scale-105 transition-all shadow-xl"
           style="background:linear-gradient(135deg,#9acb03,#b8e832);box-shadow:0 8px 32px rgba(154,203,3,0.3);">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            Konsultasi Gratis via WhatsApp
        </a>
    </div>
</section>

{{-- ===== LAYANAN GRID ===== --}}
<section class="py-20 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Apa yang Kami Kerjakan</span>
            <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white">Layanan Lengkap HVM Digital</h2>
        </div>

        @php
        $serviceIcons = [
            'globe'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
            'monitor'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
            'search'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>',
            'ai'         => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
            'code'       => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
            'smartphone' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
            'palette'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
            'video'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>',
            'cpu'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>',
            'share'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>',
            'megaphone'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
            'trending'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
            'default'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
            @forelse($services as $svc)
            <a href="{{ route('services.show', $svc) }}"
               class="group bg-white dark:bg-[#0d1f15] rounded-2xl p-7 border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/50 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col no-underline">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5
                            bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15
                            group-hover:from-[#075749] group-hover:to-[#0a6d58]
                            transition-all duration-300 shrink-0">
                    <svg class="w-6 h-6 text-[#075749] dark:text-[#9acb03] group-hover:text-white transition-colors"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $serviceIcons[$svc->icon ?? 'default'] ?? $serviceIcons['default'] !!}
                    </svg>
                </div>
                <h2 class="font-bold text-[#0a1f12] dark:text-white text-lg mb-3 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors leading-snug">
                    {{ $svc->name }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light leading-relaxed flex-grow mb-5">
                    {{ $svc->short_description }}
                </p>
                <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#075749] dark:text-[#9acb03] group-hover:gap-3 transition-all mt-auto">
                    Pelajari Layanan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">Layanan sedang diperbarui.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="py-20" style="background:linear-gradient(135deg,#075749,#9acb03);">
    <div class="container mx-auto px-4 lg:px-8 text-center max-w-2xl">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">Siap Memulai Project?</h2>
        <p class="text-white/75 font-light leading-relaxed mb-8">Konsultasi gratis 30 menit bersama tim HVM Digital — kami bantu temukan solusi terbaik untuk bisnis Anda.</p>
        <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi gratis') }}" target="_blank" rel="noopener"
           class="inline-flex items-center gap-3 bg-white text-[#075749] font-bold px-10 py-4 rounded-full hover:scale-105 hover:shadow-2xl transition-all text-base">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            Mulai Konsultasi Gratis
        </a>
    </div>
</section>

@endsection
