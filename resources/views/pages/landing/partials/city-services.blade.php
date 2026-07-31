<section class="py-20 bg-[#f0fdf4] dark:bg-[#061009]" id="layanan">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-[#0a1f12] dark:text-white mb-3">Layanan Website di {{ $cityConfig['name'] }}</h2>
            <p class="text-gray-500 dark:text-gray-400 font-light">Solusi digital lengkap untuk semua kebutuhan bisnis</p>
        </div>
        @php $svgIcons = ['M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5m4 0H9','M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z','M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z','M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z','M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4','M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z']; @endphp
        @php $services2 = [['Website Company Profile','Tampilkan profesionalisme bisnis Anda dengan tampilan elegan.'],['Toko Online / E-commerce','Jual produk online 24/7 dengan fitur katalog dan pembayaran.'],['Landing Page','Halaman promosi dengan konversi tinggi untuk produk Anda.'],['Website Portfolio','Tunjukkan karya terbaik Anda kepada dunia.'],['Aplikasi Web Custom','Sistem informasi dan aplikasi bisnis sesuai kebutuhan.'],['Website Blog / Berita','Platform konten profesional untuk bisnis Anda.']]; @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($services2 as $idx => $svc)
            <div class="bg-white dark:bg-[#0d1f15] rounded-2xl p-7 border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/40 hover:shadow-xl hover:-translate-y-0.5 transition-all group">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5" style="background: linear-gradient(135deg, rgba(7,87,73,0.12), rgba(154,203,3,0.12));">
                    <svg class="w-6 h-6 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $svgIcons[$idx] }}"/></svg>
                </div>
                <h3 class="font-semibold text-[#0a1f12] dark:text-white mb-2">{{ $svc[0] }}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light leading-relaxed">{{ $svc[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
