@extends('layouts.app')
@section('content')

<main>

{{-- ═══════════════════════════════════════════════════════════════
     HERO — matches articles page style exactly
════════════════════════════════════════════════════════════════════ --}}
<section class="relative pt-40 pb-20 overflow-hidden" style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);">
    <div class="absolute inset-0 opacity-[0.07]" style="background-image:linear-gradient(rgba(154,203,3,0.4) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl pointer-events-none" style="background:radial-gradient(circle,#9acb03,transparent);"></div>

    <div class="relative container mx-auto px-4 lg:px-8 text-center max-w-3xl">

        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-white/40 text-xs font-light mb-6 flex-wrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#9acb03]">Karir</span>
        </nav>

        <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-4">Karir Profesional</span>

        <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-5">
            Berkarir Bersama<br>
            <span style="background:linear-gradient(135deg,#9acb03,#b8e832);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">HVM Digital</span>
        </h1>

        <p class="text-white/60 text-base md:text-lg font-light leading-relaxed mb-8">
            Bergabunglah dengan tim yang dinamis dan inovatif. Kembangkan potensi Anda dalam lingkungan kerja yang profesional dan berdampak.
        </p>

        {{-- Stats --}}
        <div class="flex items-center justify-center gap-6 mt-8 text-white/40 text-xs font-light">
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                {{ $careers->count() }} posisi dibuka
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Update rutin
            </span>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     MAIN — Karir Grid
════════════════════════════════════════════════════════════════════ --}}
<section class="py-16 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8 max-w-5xl">
        <div class="grid grid-cols-1 gap-6">
            @forelse($careers as $career)
            <div class="bg-white dark:bg-[#0d1f15] rounded-3xl p-6 md:p-8 border border-[#075749]/10 dark:border-[#9acb03]/10 shadow-[0_20px_40px_rgba(0,0,0,0.02)] dark:shadow-[0_20px_40px_rgba(0,0,0,0.2)] hover:border-[#9acb03]/30 hover:-translate-y-1 transition-all duration-300">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-[#075749]/5 dark:bg-[#9acb03]/10 text-[#075749] dark:text-[#9acb03] text-xs font-semibold px-3 py-1 rounded-full">{{ $career->division }}</span>
                            <span class="text-gray-400 dark:text-white/40 text-xs font-light flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $career->duration }}</span>
                        </div>
                        <h2 class="text-2xl font-bold text-[#0a1f12] dark:text-white mb-2">{{ $career->title }}</h2>
                        <div class="flex items-center gap-2 text-gray-500 dark:text-white/50 text-sm mb-6">
                            <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $career->location }}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6 border-t border-gray-100 dark:border-white/5 pt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-[#0a1f12] dark:text-white mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Kualifikasi
                                </h3>
                                <div class="prose-hvm text-sm max-w-none">
                                    {!! $career->qualifications !!}
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-[#0a1f12] dark:text-white mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    Jobdesk
                                </h3>
                                <div class="prose-hvm text-sm max-w-none">
                                    {!! $career->jobdesc !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 md:mt-0 shrink-0 border-t md:border-t-0 border-gray-100 dark:border-white/5 pt-6 md:pt-0">
                        @php
                            $waMessage = "Halo HVM Digital, saya tertarik melamar posisi Karir: *" . $career->title . "*. Saya ingin mengetahui informasi lebih lanjut mengenai proses pendaftarannya.";
                            $applyLink = !empty($career->custom_link) ? $career->custom_link : wa_link($waMessage);
                        @endphp
                        <a href="{{ $applyLink }}" target="_blank" onclick="trackWaClick('career_apply')" class="inline-flex items-center justify-center w-full md:w-auto gap-2 bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold text-sm px-8 py-4 rounded-xl hover:scale-105 transition-all shadow-[0_4px_15px_rgba(154,203,3,0.3)]">
                            Apply Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-20 bg-white dark:bg-[#0d1f15] rounded-3xl border border-[#075749]/10 dark:border-[#9acb03]/10">
                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <h3 class="text-xl font-bold text-[#0a1f12] dark:text-white mb-2">Belum ada posisi dibuka</h3>
                <p class="text-gray-500 dark:text-white/50 font-light">Saat ini kami belum membuka lowongan pekerjaan baru. Pantau terus halaman ini untuk update selanjutnya.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

</main>

@endsection
