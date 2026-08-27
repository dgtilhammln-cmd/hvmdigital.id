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
            <span class="text-[#9acb03]">Kontak</span>
        </nav>
        <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-4">Hubungi Kami</span>
        <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-5">
            Konsultasi Gratis<br>
            <span style="background:linear-gradient(135deg,#9acb03,#b8e832);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Bersama HVM Digital</span>
        </h1>
        <p class="text-white/60 text-base md:text-lg font-light leading-relaxed">Siap bantu bisnis Anda tumbuh secara digital. Hubungi kami sekarang — gratis, tanpa komitmen.</p>
    </div>
</section>

{{-- ===== CONTACT INFO + FORM ===== --}}
<section class="py-20 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            {{-- Kiri: Info Kontak --}}
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-6">Cara Menghubungi Kami</h2>
                <p class="text-gray-500 dark:text-gray-400 font-light leading-relaxed mb-8">Tim HVM Digital siap membantu Anda menemukan solusi digital terbaik untuk bisnis Anda. Hubungi kami melalui salah satu saluran berikut.</p>

                <div class="space-y-5">
                    {{-- WhatsApp --}}
                    <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi') }}" target="_blank" rel="noopener"
                       class="flex items-center gap-4 bg-white dark:bg-[#0d1f15] rounded-2xl p-5 border border-gray-100 dark:border-white/5 hover:border-[#9acb03]/50 hover:shadow-lg transition-all group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background:linear-gradient(135deg,#25d366,#128c7e);">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-light mb-0.5">WhatsApp (Respon Cepat)</p>
                            <p class="font-semibold text-[#0a1f12] dark:text-white group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ setting('whatsapp_display','+62851-7998-2373') }}</p>
                        </div>
                    </a>

                    {{-- Email --}}
                    <a href="mailto:{{ setting('email', 'bisnis@hvm-digital.id') }}"
                       class="flex items-center gap-4 bg-white dark:bg-[#0d1f15] rounded-2xl p-5 border border-gray-100 dark:border-white/5 hover:border-[#9acb03]/50 hover:shadow-lg transition-all group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15">
                            <svg class="w-6 h-6 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-light mb-0.5">Email</p>
                            <p class="font-semibold text-[#0a1f12] dark:text-white group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">{{ setting('email', 'bisnis@hvm-digital.id') }}</p>
                        </div>
                    </a>

                    {{-- Lokasi Surabaya --}}
                    <div class="flex items-center gap-4 bg-white dark:bg-[#0d1f15] rounded-2xl p-5 border border-gray-100 dark:border-white/5">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15">
                            <svg class="w-6 h-6 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-light mb-0.5">Kantor Surabaya (Pusat)</p>
                            <p class="font-semibold text-[#0a1f12] dark:text-white text-sm">{{ setting('address_surabaya', 'Jl. Rungkut Lor VII Dalam, Surabaya, Jawa Timur') }}</p>
                        </div>
                    </div>

                    {{-- Lokasi Bekasi --}}
                    <div class="flex items-center gap-4 bg-white dark:bg-[#0d1f15] rounded-2xl p-5 border border-gray-100 dark:border-white/5">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15">
                            <svg class="w-6 h-6 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-light mb-0.5">Kantor Bekasi (Jabodetabek)</p>
                            <p class="font-semibold text-[#0a1f12] dark:text-white text-sm">{{ setting('address_bekasi', 'Kota Bekasi, Jawa Barat') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Jam Operasional --}}
                <div class="mt-8 bg-white dark:bg-[#0d1f15] rounded-2xl p-5 border border-gray-100 dark:border-white/5">
                    <h3 class="font-semibold text-[#0a1f12] dark:text-white mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Jam Operasional
                    </h3>
                    <div class="space-y-1.5 text-sm">
                        <div class="flex justify-between text-gray-500 dark:text-gray-400">
                            <span>Senin – Jumat</span>
                            <span class="font-medium text-[#0a1f12] dark:text-white">08.00 – 17.00 WIB</span>
                        </div>
                        <div class="flex justify-between text-gray-500 dark:text-gray-400">
                            <span>Sabtu</span>
                            <span class="font-medium text-[#0a1f12] dark:text-white">09.00 – 14.00 WIB</span>
                        </div>
                        <div class="flex justify-between text-gray-500 dark:text-gray-400">
                            <span>WhatsApp</span>
                            <span class="font-medium text-[#9acb03]">24 Jam</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: CTA --}}
            <div class="bg-white dark:bg-[#0d1f15] rounded-3xl p-8 border border-gray-100 dark:border-white/5 shadow-xl">
                <h2 class="text-2xl font-bold text-[#0a1f12] dark:text-white mb-2">Mulai Konsultasi Gratis</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light mb-8">Ceritakan kebutuhan bisnis Anda dan tim kami akan menghubungi dalam 1x24 jam kerja.</p>

                <div class="space-y-4">
                    <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi pembuatan website') }}" target="_blank" rel="noopener"
                       class="w-full flex items-center justify-center gap-3 font-bold px-8 py-4 rounded-2xl text-white transition-all hover:scale-[1.02] hover:shadow-xl"
                       style="background:linear-gradient(135deg,#25d366,#128c7e);">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Chat WhatsApp Sekarang
                    </a>

                    <a href="mailto:{{ setting('email', 'bisnis@hvm-digital.id') }}?subject=Konsultasi%20Layanan%20HVM%20Digital"
                       class="w-full flex items-center justify-center gap-3 font-semibold px-8 py-4 rounded-2xl border-2 border-[#075749]/20 hover:border-[#075749] text-[#075749] dark:text-[#9acb03] dark:border-[#9acb03]/20 dark:hover:border-[#9acb03] transition-all hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Kirim Email
                    </a>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-white/5">
                    <p class="text-xs text-center text-gray-400 dark:text-gray-500">Kami akan merespon dalam <span class="font-semibold text-[#075749] dark:text-[#9acb03]">1x24 jam kerja</span>. Konsultasi 100% gratis, tanpa komitmen.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== FAQ ===== --}}
<section class="py-16 bg-white dark:bg-[#0a1f12] border-t border-gray-100 dark:border-white/10">
    <div class="container mx-auto px-4 lg:px-8 max-w-3xl">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="space-y-4">
            @php
            $faqs = [
                ['q' => 'Berapa biaya konsultasi?', 'a' => 'Konsultasi dengan tim HVM Digital sepenuhnya GRATIS. Kami akan membantu Anda menentukan solusi terbaik sesuai kebutuhan dan anggaran bisnis Anda.'],
                ['q' => 'Berapa lama proses pengerjaan website?', 'a' => 'Proses pengerjaan tergantung kompleksitas proyek. Landing page sederhana: 3–5 hari kerja. Website perusahaan: 7–14 hari kerja. Website e-commerce: 14–30 hari kerja.'],
                ['q' => 'Apakah ada garansi setelah website selesai?', 'a' => 'Ya! Kami memberikan garansi maintenance gratis selama 30 hari setelah website diluncurkan. Jika ada bug atau masalah teknis, kami siap menangani tanpa biaya tambahan.'],
                ['q' => 'Bagaimana cara pembayaran?', 'a' => 'Kami menerima berbagai metode pembayaran: transfer bank, e-wallet (GoPay, OVO, Dana), dan kartu kredit. Untuk proyek, biasanya DP 50% di awal dan pelunasan setelah website selesai.'],
            ];
            @endphp
            @foreach($faqs as $faq)
            <details class="bg-[#f0fdf4] dark:bg-[#0d1f15] rounded-2xl border border-gray-100 dark:border-white/5 group">
                <summary class="flex items-center justify-between p-5 cursor-pointer font-semibold text-[#0a1f12] dark:text-white list-none">
                    {{ $faq['q'] }}
                    <svg class="w-5 h-5 text-[#9acb03] shrink-0 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <p class="px-5 pb-5 text-gray-500 dark:text-gray-400 text-sm font-light leading-relaxed">{{ $faq['a'] }}</p>
            </details>
            @endforeach
        </div>
    </div>
</section>

@endsection
