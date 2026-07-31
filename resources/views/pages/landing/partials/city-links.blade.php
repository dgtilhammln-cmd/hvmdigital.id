<section class="py-10 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between gap-3 mb-4">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <h3 class="text-[#075749] dark:text-[#9acb03] font-semibold text-xs tracking-widest uppercase">Layanan di Kota Lain</h3>
            </div>
            <a href="{{ route('services') }}" class="text-xs text-[#075749] dark:text-[#9acb03] hover:underline font-medium">
                Lihat Semua Kota &rarr;
            </a>
        </div>
        <div class="flex flex-wrap gap-2">
            @php $count = 0; @endphp
            @foreach(config('cities') as $cityKey => $cityItem)
                @if($cityKey !== $city && $count < 12)
                <a href="{{ url($cityItem['slug']) }}"
                   class="bg-white dark:bg-[#0d1f15] border border-[#075749]/15 dark:border-[#9acb03]/15 text-gray-500 dark:text-gray-400 text-xs font-light px-4 py-2 rounded-full hover:border-[#9acb03] hover:text-[#075749] dark:hover:text-[#9acb03] transition-all">
                    Website {{ $cityItem['name'] }}
                </a>
                @php $count++; @endphp
                @endif
            @endforeach
        </div>
    </div>
</section>
