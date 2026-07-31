@extends('layouts.app')
@section('content')

<main class="bg-[#f0fdf4] dark:bg-[#061009] min-h-screen">

{{-- ═══════════════════════════════════════════════════════════════
     1. HERO SECTION
════════════════════════════════════════════════════════════════════ --}}
<section class="relative pt-40 pb-20 overflow-hidden" style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);">
    <div class="absolute inset-0 opacity-[0.07]" style="background-image:linear-gradient(rgba(154,203,3,0.4) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl pointer-events-none" style="background:radial-gradient(circle,#9acb03,transparent);"></div>

    <div class="relative container mx-auto px-4 lg:px-8 text-center max-w-4xl">
        <nav class="flex items-center justify-center gap-2 text-white/40 text-xs font-light mb-6 flex-wrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('services') }}" class="hover:text-white transition-colors">Layanan</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#9acb03]">Jasa Optimasi SEO Halaman 1</span>
        </nav>

        <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-4">Jasa Optimasi SEO Profesional</span>

        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
            Jasa SEO Profesional Terbaik: Dominasi Halaman 1 Google<br>
            <span style="background:linear-gradient(135deg,#9acb03,#b8e832);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Tingkatkan Omset Bisnis Anda</span>
        </h1>

        <p class="text-white/60 text-base md:text-lg font-light leading-relaxed mb-10 max-w-3xl mx-auto">
            HVM Digital membantu website bisnis B2B dan perusahaan Anda menempati peringkat teratas mesin pencari, mendatangkan trafik tertarget, dan mengonversi pengunjung menjadi pelanggan setia.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#konsultasi" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 rounded-full bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-bold text-sm hover:scale-105 transition-all shadow-[0_0_20px_rgba(7,87,73,0.4)]">
                Mulai Konsultasi Gratis
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="#keberhasilan" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 rounded-full bg-white/5 text-white font-medium text-sm hover:bg-white/10 transition-colors border border-white/10">
                Lihat Keberhasilan Client
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     2. KENAPA BUTUH SEO?
════════════════════════════════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <div class="flex-1 space-y-6">
                <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-2">Fundamental Bisnis Digital</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white leading-tight">
                    Kenapa Bisnis Anda <span class="text-[#075749] dark:text-[#9acb03]">Butuh SEO?</span>
                </h2>
                <div class="space-y-4 text-gray-600 dark:text-white/60 font-light leading-relaxed">
                    <p>Di era digital, memiliki website saja tidak cukup. Jika calon klien tidak dapat menemukan Anda di halaman pertama hasil pencarian, Anda akan kehilangan peluang besar dan memberikannya kepada kompetitor.</p>
                    <p>Optimasi Mesin Pencari (SEO) adalah investasi jangka panjang yang berfungsi sebagai *sales person* yang bekerja 24 jam sehari, 7 hari seminggu. SEO memastikan bisnis Anda ditemukan tepat saat target market sedang mencari produk atau layanan yang Anda tawarkan.</p>
                </div>
                <div class="pt-4 grid grid-cols-2 gap-4">
                    <div class="bg-white dark:bg-[#0d1f15] p-5 rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm">
                        <div class="text-3xl font-bold text-[#075749] dark:text-[#9acb03] mb-1">24/7</div>
                        <div class="text-xs text-gray-500 dark:text-white/50 uppercase tracking-wider font-semibold">Trafik Organik Non-Stop</div>
                    </div>
                    <div class="bg-white dark:bg-[#0d1f15] p-5 rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm">
                        <div class="text-3xl font-bold text-[#075749] dark:text-[#9acb03] mb-1">Ratusan</div>
                        <div class="text-xs text-gray-500 dark:text-white/50 uppercase tracking-wider font-semibold">Leads Potensial / Bulan</div>
                    </div>
                </div>
            </div>
            
            <div class="flex-1 w-full relative flex items-center justify-center">
                @php $img1 = setting('seo_page_section1_image'); @endphp
                @if($img1)
                    <img src="{{ get_image_url($img1) }}" alt="Kenapa Butuh SEO" class="relative z-10 w-full h-auto object-contain" loading="lazy">
                @else
                    <div class="relative z-10 w-full aspect-[4/3] flex items-center justify-center">
                        <span class="text-gray-400 dark:text-white/30 font-light">[Gambar Admin: seo_page_section1_image]</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     3. KENAPA HARUS DI GOOGLE?
════════════════════════════════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-white dark:bg-[#0a1f12] border-y border-gray-100 dark:border-white/5 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-[#f0fdf4] dark:from-[#0d1f15] to-transparent opacity-50"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Google Dominance</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white leading-tight mb-6">
                Kenapa Harus Berada di <span class="text-[#075749] dark:text-[#9acb03]">Google?</span>
            </h2>
            <p class="text-gray-600 dark:text-white/60 font-light">
                Google menguasai lebih dari 90% pangsa pasar mesin pencari global. Tidak ada tempat yang lebih strategis untuk membangun visibilitas bisnis Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            {{-- Poin 1 --}}
            <div class="bg-gray-50 dark:bg-[#0d1f15] p-8 rounded-3xl border border-gray-100 dark:border-white/5 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 bg-white dark:bg-[#0a1f12] rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 dark:border-white/5 mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#0a1f12] dark:text-white mb-3">Niat Beli (Intent) yang Tinggi</h3>
                <p class="text-sm text-gray-500 dark:text-white/50 font-light leading-relaxed">
                    Pengguna Google secara aktif mengetikkan kata kunci yang spesifik karena mereka *membutuhkan solusi*. Trafik ini memiliki tingkat konversi tertinggi dibanding media sosial.
                </p>
            </div>
            
            {{-- Poin 2 --}}
            <div class="bg-gray-50 dark:bg-[#0d1f15] p-8 rounded-3xl border border-gray-100 dark:border-white/5 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 bg-white dark:bg-[#0a1f12] rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 dark:border-white/5 mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#0a1f12] dark:text-white mb-3">Membangun Kredibilitas</h3>
                <p class="text-sm text-gray-500 dark:text-white/50 font-light leading-relaxed">
                    Website yang tampil di halaman 1 Google secara otomatis dianggap lebih profesional, bonafid, dan tepercaya di mata calon pelanggan bisnis (B2B) Anda.
                </p>
            </div>
            
            {{-- Poin 3 --}}
            <div class="bg-gray-50 dark:bg-[#0d1f15] p-8 rounded-3xl border border-gray-100 dark:border-white/5 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 bg-white dark:bg-[#0a1f12] rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 dark:border-white/5 mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#0a1f12] dark:text-white mb-3">Investasi Jangka Panjang</h3>
                <p class="text-sm text-gray-500 dark:text-white/50 font-light leading-relaxed">
                    Tidak seperti iklan berbayar (Ads) yang trafiknya akan berhenti begitu budget habis, hasil dari SEO akan terus mendatangkan trafik secara organik selama bertahun-tahun.
                </p>
            </div>
            
            {{-- Poin 4 --}}
            <div class="bg-gray-50 dark:bg-[#0d1f15] p-8 rounded-3xl border border-gray-100 dark:border-white/5 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 bg-white dark:bg-[#0a1f12] rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 dark:border-white/5 mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#0a1f12] dark:text-white mb-3">Dominasi Pasar Kompetitor</h3>
                <p class="text-sm text-gray-500 dark:text-white/50 font-light leading-relaxed">
                    Jika Anda tidak mengambil porsi di halaman pertama, berarti kompetitor Anda yang akan mengambilnya. Menguasai kata kunci berarti mengunci pangsa pasar di industri Anda.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     4. KENAPA PENGUSAHA MEMPERCAYAKAN SEO DI HVM DIGITAL
════════════════════════════════════════════════════════════════════ --}}
<section class="py-24 relative overflow-hidden" style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);">
    <div class="absolute top-0 right-0 w-full h-full" style="background-image:linear-gradient(rgba(154,203,3,0.1) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.1) 1px,transparent 1px);background-size:60px 60px;"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 bg-[#9acb03]/10 border border-[#9acb03]/20 text-[#9acb03] text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Exclusive SEO Agency
            </span>
            <h2 class="text-3xl md:text-5xl font-montserrat font-light tracking-tight text-white leading-tight mb-8">
                Kenapa Pengusaha Indonesia Mempercayakan <span class="font-bold text-[#9acb03]">SEO di HVM Digital?</span>
            </h2>
            <p class="text-lg md:text-xl text-white/70 font-light leading-relaxed mb-10">
                Kami bukan sekadar menjual layanan optimasi, kami menjadi *partner strategis* pertumbuhan bisnis Anda. HVM Digital menggunakan pendekatan *White-Hat SEO* yang aman, bergaransi, dan sepenuhnya transparan.
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-left">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-md hover:bg-white/10 hover:-translate-y-1 transition-all">
                    <svg class="w-10 h-10 text-[#9acb03] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    <div class="text-[#9acb03] font-bold text-lg mb-1">Strategi</div>
                    <div class="text-white/50 text-xs font-light">Custom sesuai industri</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-md hover:bg-white/10 hover:-translate-y-1 transition-all">
                    <svg class="w-10 h-10 text-[#9acb03] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-[#9acb03] font-bold text-lg mb-1">Audit</div>
                    <div class="text-white/50 text-xs font-light">Mendalam & Menyeluruh</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-md hover:bg-white/10 hover:-translate-y-1 transition-all">
                    <svg class="w-10 h-10 text-[#9acb03] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <div class="text-[#9acb03] font-bold text-lg mb-1">Laporan</div>
                    <div class="text-white/50 text-xs font-light">Transparan tiap bulan</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-md hover:bg-white/10 hover:-translate-y-1 transition-all">
                    <svg class="w-10 h-10 text-[#9acb03] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-[#9acb03] font-bold text-lg mb-1">Hasil</div>
                    <div class="text-white/50 text-xs font-light">Fokus pada ROI/Omset</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     5. KEBERHASILAN CLIENT KAMI (GRID 4 IMAGES)
════════════════════════════════════════════════════════════════════ --}}
<section id="keberhasilan" class="py-20 lg:py-28 relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Proven Results</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white leading-tight">
                Bukti <span class="text-[#075749] dark:text-[#9acb03]">Keberhasilan Klien</span> Kami
            </h2>
            <p class="text-gray-600 dark:text-white/60 font-light mt-4">
                Kami bangga telah membantu puluhan bisnis mendominasi kata kunci sulit di halaman 1 pencarian Google.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            @for($i = 1; $i <= 4; $i++)
                @php $imgKey = 'seo_page_success_img'.$i; $img = setting($imgKey); @endphp
                <div class="relative group rounded-3xl overflow-hidden shadow-xl border border-gray-100 dark:border-white/5 aspect-[3054/3818]">
                    @if($img)
                        <img src="{{ get_image_url($img) }}" alt="Keberhasilan Klien {{ $i }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                    @else
                        <div class="w-full h-full bg-gray-100 dark:bg-[#0d1f15] flex items-center justify-center text-gray-400 dark:text-white/30 text-sm font-light">
                            [Gambar Admin: {{ $imgKey }}] (3054x3818)
                        </div>
                    @endif
                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            @endfor
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     6. BEBERAPA KLIEN KAMI (TICKER)
════════════════════════════════════════════════════════════════════ --}}
<section class="py-16 bg-white dark:bg-[#0a1f12] border-y border-gray-100 dark:border-white/5 overflow-hidden">
    @include('pages.partials.clients')
</section>

{{-- ═══════════════════════════════════════════════════════════════
     7. BIDANG APA YANG COCOK? (6 B2B CARDS)
════════════════════════════════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Industri B2B</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white leading-tight">
                Bidang Apa Saja yang <span class="text-[#075749] dark:text-[#9acb03]">Cocok Menggunakan SEO?</span>
            </h2>
            <p class="text-gray-600 dark:text-white/60 font-light mt-4">
                SEO sangat efektif untuk bisnis jenis *Business-to-Business* (B2B) atau perusahaan yang mengincar tender, suplai korporat, dan transaksi bernilai tinggi.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @php
            $industries = [
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>', 'title' => 'Kontraktor & Konstruksi', 'desc' => 'Dapatkan tender besar dan klien komersial yang sedang mencari jasa arsitektur, sipil, atau *MEP* terbaik di kota Anda.'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>', 'title' => 'Manufaktur & Pabrik', 'desc' => 'Kuasai pencarian Google untuk kata kunci suplai barang grosir, mesin industri, dan material manufaktur.'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>', 'title' => 'Logistik & Ekspedisi', 'desc' => 'Pastikan layanan pengiriman, sewa gudang, atau *freight forwarding* Anda ditemukan oleh perusahaan importir.'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>', 'title' => 'Corporate Services', 'desc' => 'Firma hukum, konsultan pajak, hingga jasa keamanan (*security*) sangat bergantung pada visibilitas *search intent* di Google.'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>', 'title' => 'IT & Software B2B', 'desc' => 'Jual lisensi *software*, ERP, atau layanan *cloud server* langsung ke perusahaan yang membutuhkan solusi IT.'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>', 'title' => 'Distributor & Supplier', 'desc' => 'Ditemukan oleh para *retailer* dan pedagang yang aktif mencari distributor terpercaya via mesin pencari Google.'],
            ];
            @endphp

            @foreach($industries as $industry)
            <div class="bg-white dark:bg-[#0d1f15] p-8 rounded-3xl border border-gray-100 dark:border-white/5 hover:border-[#075749]/30 dark:hover:border-[#9acb03]/30 hover:shadow-lg transition-all duration-300 group">
                <div class="w-12 h-12 bg-[#075749]/5 dark:bg-[#9acb03]/10 text-[#075749] dark:text-[#9acb03] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $industry['icon'] !!}</svg>
                </div>
                <h3 class="text-xl font-bold text-[#0a1f12] dark:text-white mb-3 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ $industry['title'] }}</h3>
                <p class="text-sm text-gray-500 dark:text-white/50 font-light leading-relaxed">
                    {{ $industry['desc'] }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     8. PRIVATE DISCUSSION CTA
════════════════════════════════════════════════════════════════════ --}}
<section id="konsultasi" class="py-16 md:py-20 bg-white dark:bg-[#0a1510]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl max-w-6xl mx-auto"
             style="background: linear-gradient(to right, #075749 0%, #9acb03 100%);">
            
            {{-- Subtle glow background --}}
            <div class="absolute top-0 right-1/4 w-72 h-72 rounded-full opacity-20 blur-3xl pointer-events-none" style="background:radial-gradient(circle,#ffffff,transparent);"></div>
            <div class="absolute inset-0 opacity-[0.05] pointer-events-none" style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 24px 24px;"></div>

            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 p-8 md:p-10 relative z-10">
                
                {{-- Left: Visual asset (Synchronized with Homepage CTA setting) --}}
                <div class="w-full lg:w-1/4 relative flex items-center justify-center shrink-0">
                    @php $ctaImage = setting('cta_section_image'); @endphp
                    @if($ctaImage)
                    <img src="{{ get_image_url($ctaImage) }}"
                         alt="Jasa Optimasi SEO Profesional - Diskusi Strategi Private"
                         class="max-w-full h-auto max-h-[220px] object-contain object-center hover:scale-105 transition-transform duration-500 drop-shadow-xl"
                         loading="lazy">
                    @else
                    <img src="{{ asset('images/free-discussion.webp') }}"
                         alt="Jasa Optimasi SEO Profesional - Diskusi Strategi Private"
                         class="max-w-full h-auto max-h-[220px] object-contain object-center hover:scale-105 transition-transform duration-500 drop-shadow-xl"
                         loading="lazy">
                    @endif
                </div>

                {{-- Middle: Minimalist CTA Text --}}
                <div class="flex-1 text-center lg:text-left px-0 lg:px-4">
                    <span class="inline-block bg-[#053d33] text-[#9acb03] text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest mb-3 shadow-sm border border-[#9acb03]/20">100% Gratis &middot; Tanpa Komitmen</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 tracking-tight">
                        Free Private Discussion Offline &amp; Online
                    </h2>
                    <p class="text-sm md:text-base text-white/90 font-light leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Bedah tuntas potensi SEO website bisnis Anda bersama pakar kami secara langsung. Slot terbatas eksklusif hanya <strong class="text-white font-semibold">1x dalam 1 bulan</strong>!
                    </p>
                </div>

                {{-- Right: Single WhatsApp Button --}}
                <div class="flex w-full sm:w-auto shrink-0 justify-center">
                    <a href="{{ wa_link('Halo HVM Digital, saya ingin jadwal Free Private Discussion Offline/Online (Slot 1x Sebulan) untuk strategi SEO bisnis saya.') }}" 
                       target="_blank" rel="noopener" onclick="trackWaClick('seo-30min-cta')"
                       class="wa-btn w-full sm:w-auto inline-flex items-center justify-center gap-3 font-bold px-8 py-4 rounded-xl bg-white text-[#075749] hover:bg-gray-100 hover:scale-105 transition-all shadow-[0_10px_25px_rgba(0,0,0,0.25)] text-base">
                        <svg class="w-6 h-6 fill-current text-[#25D366]" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Booking via WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     8B. COVERAGE AREA (SEO SELURUH INDONESIA)
════════════════════════════════════════════════════════════════════ --}}
@include('pages.partials.map', [
    'subTitle' => 'Coverage Area',
    'mainTitle' => 'Jasa SEO Seluruh Indonesia',
    'itemTitlePrefix' => 'Jasa SEO',
    'waLinks' => true
])

{{-- ═══════════════════════════════════════════════════════════════
     9. FAQ (Pertanyaan Umum)
════════════════════════════════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-[#f0fdf4] dark:bg-[#061009] border-t border-gray-100 dark:border-white/5">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl">
        <div class="text-center mb-12">
            <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Tanya Jawab</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white leading-tight">
                Pertanyaan Umum Seputar SEO
            </h2>
        </div>

        <div class="space-y-4">
            @php
            $seoFaqs = [
                [
                    'q' => 'Berapa lama waktu yang dibutuhkan agar website saya masuk Halaman 1 Google?',
                    'a' => '<p>SEO adalah investasi jangka panjang dan tidak menjanjikan hasil instan (berbeda dengan iklan berbayar/Google Ads). Secara umum, Anda akan mulai melihat pergerakan positif dalam <strong>3 hingga 6 bulan</strong>.</p><p class="mt-2">Waktu pastinya sangat bergantung pada tingkat kompetisi industri Anda, otoritas website Anda saat ini, dan kondisi teknis website. Kami berfokus pada teknik <em>White-Hat SEO</em> yang aman dan memastikan peringkat Anda bertahan lama, bukan trik instan yang berisiko terkena penalti Google.</p>'
                ],
                [
                    'q' => 'Apakah ada jaminan pasti peringkat 1 di Google?',
                    'a' => '<p>Tidak ada agensi SEO profesional di dunia yang bisa menjamin peringkat #1 mutlak. Google secara eksplisit memperingatkan pemilik bisnis untuk berhati-hati terhadap pihak yang menjanjikan peringkat 1 secara instan.</p><p class="mt-2">Yang HVM Digital jamin adalah penerapan strategi dan optimasi sesuai panduan resmi Google (Best Practices), laporan analitik yang 100% transparan, serta dedikasi tim kami untuk menargetkan kata kunci yang menghasilkan prospek (leads) dan keuntungan nyata (ROI) bagi bisnis Anda.</p>'
                ],
                [
                    'q' => 'Apa bedanya SEO dengan Google Ads (Iklan Berbayar)?',
                    'a' => '<p><strong>Google Ads (SEM)</strong> ibarat menyewa ruang iklan: Website Anda akan langsung tampil di atas, namun begitu budget habis, website Anda akan langsung menghilang.</p><p class="mt-2"><strong>SEO</strong> ibarat membangun aset properti: Membutuhkan waktu untuk dibangun, namun saat website Anda sudah mendominasi halaman 1 secara organik, Anda akan terus mendapatkan trafik setiap hari tanpa perlu membayar biaya klik (PPC) ke Google. Idealnya, bisnis skala menengah ke atas memadukan keduanya.</p>'
                ],
                [
                    'q' => 'Apakah layanan ini sudah termasuk perbaikan website?',
                    'a' => '<p>Ya, untuk perbaikan teknis skala menengah seperti optimasi kecepatan (PageSpeed), perbaikan struktur URL, meta tags, dan perbaikan error indexing, tim developer kami akan menanganinya secara langsung (Technical SEO).</p><p class="mt-2">Namun, sebagai langkah edukasi: jika platform atau struktur dasar website Anda saat ini sudah usang, menggunakan sistem tertutup yang tidak ramah SEO, atau memiliki kode yang sangat berat/kotor, maka optimasi tidak akan berjalan optimal. Dalam kasus tersebut, kami akan memberikan transparansi penuh di awal dan menyarankan untuk melakukan <strong>rebuild (pembuatan ulang) website</strong> menggunakan standar teknologi modern yang terbukti SEO-friendly.</p>'
                ],
                [
                    'q' => 'Bagaimana saya tahu jika investasi SEO saya membuahkan hasil?',
                    'a' => '<p>Kami tidak hanya memberikan laporan peringkat (ranking). HVM Digital akan mengirimkan <strong>laporan performa komprehensif setiap bulan</strong> yang mencakup:</p><ul class="list-disc pl-5 mt-2 space-y-1"><li>Pertumbuhan trafik organik.</li><li>Peningkatan tayangan (impressions) dan klik (CTR).</li><li>Konversi atau prospek (leads) yang masuk (seperti klik tombol WhatsApp atau pengisian form).</li></ul>'
                ]
            ];
            @endphp

            @foreach($seoFaqs as $index => $faq)
            <div x-data="{ open: false }" class="bg-white dark:bg-[#0d1f15] border border-gray-100 dark:border-white/5 rounded-2xl overflow-hidden transition-all duration-300" :class="open ? 'shadow-md border-[#075749]/30 dark:border-[#9acb03]/30' : 'hover:border-gray-200 dark:hover:border-white/10'">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between gap-4 text-left focus:outline-none">
                    <span class="font-bold text-[#0a1f12] dark:text-white text-base md:text-lg pr-4">{{ $faq['q'] }}</span>
                    <span class="w-8 h-8 shrink-0 flex items-center justify-center rounded-full bg-gray-50 dark:bg-white/5 text-[#075749] dark:text-[#9acb03] transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </button>
                <div x-show="open" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-white/60 font-light leading-relaxed max-w-none text-sm md:text-base">
                        {!! $faq['a'] !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- RELATED ARTICLES / WAWASAN DIGITAL --}}
<section class="py-16 bg-white dark:bg-[#0a1f12] border-t border-gray-100 dark:border-white/5">
    <div class="container mx-auto px-4 lg:px-8 max-w-6xl">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-2">Wawasan Digital</span>
                <h2 class="text-3xl font-bold text-[#0a1f12] dark:text-white leading-tight">
                    Artikel & <span class="text-[#075749] dark:text-[#9acb03]">Tips Terbaru</span>
                </h2>
            </div>
            <a href="{{ route('articles') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-semibold text-[#075749] dark:text-[#9acb03] hover:underline">
                Lihat Semua Artikel <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(\App\Models\Article::published()->latest('published_at')->take(3)->get() as $art)
            <article class="bg-gray-50 dark:bg-[#0d1f15] rounded-3xl overflow-hidden border border-gray-100 dark:border-white/5 flex flex-col group hover:-translate-y-1 transition-all duration-300 shadow-sm hover:shadow-xl">
                <div class="relative aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-[#0a1f12]">
                    @if($art->featured_image)
                    <img src="{{ asset('storage/'.$art->featured_image) }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-white/30 text-xs font-light">No Image</div>
                    @endif
                    <div class="absolute top-4 left-4 bg-white/90 dark:bg-[#0a1f12]/90 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-semibold text-[#075749] dark:text-[#9acb03]">
                        {{ $art->articleCategory?->name ?? $art->category ?? 'Digital Marketing' }}
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="text-[11px] text-gray-400 dark:text-white/40 mb-2 font-light">
                            {{ $art->published_at?->format('d M Y') ?? $art->created_at->format('d M Y') }}
                        </div>
                        <h3 class="font-bold text-[#0a1f12] dark:text-white text-lg mb-3 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-white/60 line-clamp-3 font-light leading-relaxed mb-6">
                            {{ $art->excerpt }}
                        </p>
                    </div>
                    <a href="{{ route('articles.show', $art->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#075749] dark:text-[#9acb03] group-hover:translate-x-1 transition-transform">
                        Baca Selengkapnya <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

</main>

@endsection
