@extends('errors.layout')

@section('title', '404 — Halaman Tidak Ditemukan')
@section('description', 'Halaman yang Anda cari tidak ditemukan. Mungkin sudah dipindahkan atau dihapus.')

@section('content')

{{-- ===== HERO / MAIN ERROR SECTION ===== --}}
<section class="relative pt-40 pb-32 min-h-[80vh] flex flex-col justify-center overflow-hidden"
         style="background: linear-gradient(135deg, #053d33 0%, #075749 60%, #0a6d58 100%);">

    {{-- Background grid --}}
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(rgba(154,203,3,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(154,203,3,0.5) 1px, transparent 1px); background-size: 48px 48px;">
    </div>

    {{-- Floating orbs --}}
    <div class="absolute top-20 right-10 w-80 h-80 rounded-full opacity-10 blur-3xl pointer-events-none animate-pulse"
         style="background: radial-gradient(circle, #9acb03, transparent);"></div>
    <div class="absolute bottom-10 left-10 w-64 h-64 rounded-full opacity-10 blur-3xl pointer-events-none"
         style="background: radial-gradient(circle, #075749, transparent); animation: pulse 4s ease-in-out infinite 1s;"></div>

    <div class="relative container mx-auto px-4 lg:px-8 text-center max-w-3xl">

        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-white/40 text-xs font-light mb-12" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#9acb03]">Error 404</span>
        </nav>

        {{-- Big 404 number --}}
        <div class="relative mb-6 inline-block select-none">
            <span class="text-[140px] md:text-[200px] font-black leading-none"
                  style="background: linear-gradient(135deg, rgba(154,203,3,0.15), rgba(154,203,3,0.05)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; filter: drop-shadow(0 0 40px rgba(154,203,3,0.15));">
                404
            </span>
            {{-- Glowing overlay --}}
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-24 h-24 rounded-full" style="background: radial-gradient(circle, rgba(154,203,3,0.12), transparent); filter: blur(20px);"></div>
            </div>
        </div>

        {{-- Icon --}}
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center"
                 style="background: linear-gradient(135deg, rgba(154,203,3,0.15), rgba(7,87,73,0.3)); border: 1px solid rgba(154,203,3,0.2);">
                <svg class="w-10 h-10 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
            Halaman Tidak Ditemukan
        </h1>
        <p class="text-white/55 text-base md:text-lg font-light leading-relaxed mb-10 max-w-xl mx-auto">
            Ups! Halaman yang Anda cari sepertinya sudah dipindahkan, dihapus, atau memang tidak pernah ada.
            Tapi jangan khawatir, kami bisa membantu Anda menemukan jalan.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pb-12 md:pb-16">
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-2.5 font-semibold px-8 py-4 rounded-full text-white hover:scale-105 transition-all shadow-xl bg-gradient-to-r from-[#075749] to-[#9acb03]"
               style="box-shadow: 0 8px 32px rgba(154,203,3,0.3);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Beranda
            </a>
            <a href="{{ url('/layanan') }}"
               class="inline-flex items-center gap-2.5 font-semibold px-8 py-4 rounded-full text-white border border-white/20 hover:border-[#9acb03]/50 hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                Lihat Layanan Kami
            </a>
        </div>
    </div>
</section>

{{-- ===== QUICK LINKS SECTION ===== --}}
<section class="py-16 bg-[#f0fdf4] dark:bg-[#061009] border-t border-gray-100 dark:border-white/5">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl">
        <div class="text-center mb-10">
            <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Navigasi Cepat</span>
            <h2 class="text-xl md:text-2xl font-bold text-[#0a1f12] dark:text-white">Halaman yang Mungkin Anda Cari</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
            $quickLinks = [
                ['href' => url('/layanan'), 'label' => 'Layanan', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>'],
                ['href' => url('/portfolio'), 'label' => 'Portfolio', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
                ['href' => url('/artikel'), 'label' => 'Artikel', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
                ['href' => url('/kontak'), 'label' => 'Kontak', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
            ];
            @endphp

            @foreach($quickLinks as $link)
            <a href="{{ $link['href'] }}"
               class="group bg-white dark:bg-[#0d1f15] rounded-2xl p-5 border border-gray-100 dark:border-white/5 hover:border-[#9acb03]/50 hover:shadow-lg transition-all flex flex-col items-center text-center gap-3">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15 group-hover:from-[#075749] group-hover:to-[#0a6d58] transition-all">
                    <svg class="w-6 h-6 text-[#075749] dark:text-[#9acb03] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $link['icon'] !!}
                    </svg>
                </div>
                <span class="font-semibold text-sm text-[#0a1f12] dark:text-white group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ $link['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
