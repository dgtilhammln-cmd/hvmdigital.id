@extends('errors.layout')

@section('title', '500 — Terjadi Kesalahan Server')
@section('description', 'Server mengalami masalah teknis. Tim kami sedang bekerja untuk memperbaikinya.')

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
            <span class="text-[#9acb03]">Error 500</span>
        </nav>

        {{-- Big number --}}
        <div class="relative mb-6 inline-block select-none">
            <span class="text-[140px] md:text-[200px] font-black leading-none"
                  style="background: linear-gradient(135deg, rgba(154,203,3,0.15), rgba(154,203,3,0.05)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; filter: drop-shadow(0 0 40px rgba(154,203,3,0.15));">
                500
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
            Terjadi Kesalahan Server
        </h1>
        <p class="text-white/55 text-base md:text-lg font-light leading-relaxed mb-10 max-w-xl mx-auto">
            Oops! Server kami sedang mengalami masalah teknis. Tim kami sudah mendapat notifikasi dan sedang bekerja untuk memperbaikinya. Silakan coba lagi dalam beberapa saat.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pb-12 md:pb-16">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 font-semibold px-8 py-4 rounded-full text-white hover:scale-105 transition-all shadow-xl bg-gradient-to-r from-[#075749] to-[#9acb03]" style="box-shadow: 0 8px 32px rgba(154,203,3,0.3);"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Kembali ke Beranda</a> <button onclick="window.location.reload()" class="inline-flex items-center gap-2.5 font-semibold px-8 py-4 rounded-full text-white border border-white/20 hover:border-[#9acb03]/50 hover:bg-white/5 transition-all cursor-pointer"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Coba Lagi</button>
        </div>
    </div>
</section>

{{-- Quick Contact --}}
<section class="py-14 bg-[#f9fafb] dark:bg-[#061009] border-t border-gray-100 dark:border-white/5">
    <div class="container mx-auto px-4 lg:px-8 max-w-2xl text-center">
        <h2 class="text-xl font-bold text-[#0a1f12] dark:text-white mb-3">Butuh Bantuan?</h2>
        <p class="text-gray-500 dark:text-gray-400 text-sm font-light mb-6">Jika masalah ini terus berlanjut, hubungi tim teknis kami langsung via WhatsApp.</p>
        <a href="{{ function_exists('wa_link') ? wa_link('Halo, saya melihat halaman error 500 di hvm-digital.id') : '#' }}"
           target="_blank" rel="noopener"
           class="inline-flex items-center gap-2.5 font-semibold px-7 py-3.5 rounded-full text-white transition-all hover:scale-105"
           style="background: linear-gradient(135deg, #25d366, #128c7e);">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            Hubungi Tim Teknis
        </a>
    </div>
</section>

@endsection