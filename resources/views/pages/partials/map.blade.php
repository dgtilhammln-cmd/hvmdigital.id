{{-- Indonesia Map Section: Alpine Tabs & Glowing Map --}}
<section class="py-24 bg-[#0a1f12] relative overflow-hidden" x-data="{ tab: 'all' }">
    {{-- Glow Effects --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-[#9acb03] rounded-full blur-[150px] opacity-10 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-[#075749] rounded-full blur-[150px] opacity-30 pointer-events-none"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center mb-12">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#9acb03] mb-3">{{ $subTitle ?? 'Jangkauan Layanan' }}</span>
            <h2 class="text-3xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300 mb-4">{{ $mainTitle ?? 'Melayani Seluruh Indonesia' }}</h2>
            <p class="text-white/60 font-light text-sm md:text-base max-w-2xl mx-auto">
                @if(isset($waLinks) && $waLinks)
                Dari Surabaya, jangkauan layanan SEO kami mencakup {{ count(config('cities')) }}+ kota dan kabupaten di seluruh penjuru Nusantara. Pilih wilayah Anda untuk terhubung langsung dengan konsultan kami via WhatsApp.
                @elseif(isset($noLinks) && $noLinks)
                Dari Surabaya, jangkauan layanan SEO kami mencakup {{ count(config('cities')) }}+ kota dan kabupaten di seluruh penjuru Nusantara. Pilih wilayah Anda dan konsultasikan strategi dominasi organik bersama ahlinya.
                @else
                Dari Surabaya, kami melayani {{ count(config('cities')) }} kota di seluruh penjuru Nusantara. Pilih wilayah Anda dan konsultasikan kebutuhan bisnis bersama ahlinya.
                @endif
            </p>
        </div>

        {{-- Map Image without Box --}}
        <div class="relative mb-16 max-w-5xl mx-auto group">
            {{-- Pulse effect behind map --}}
            <div class="absolute inset-0 bg-gradient-to-r from-[#075749] to-[#9acb03] opacity-0 group-hover:opacity-20 blur-3xl transition-opacity duration-1000 rounded-full"></div>
            <img src="{{ asset('images/maps/mapindonesia.png') }}"
                 alt="Peta Layanan HVM Digital"
                 class="w-full h-auto object-contain drop-shadow-[0_0_30px_rgba(154,203,3,0.3)] hover:scale-[1.02] transition-transform duration-700"
                 loading="lazy">
        </div>

        {{-- Region Filter Tabs --}}
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <button @click="tab = 'all'" :class="tab === 'all' ? 'bg-[#9acb03] text-[#0a1f12] font-bold shadow-[0_0_20px_rgba(154,203,3,0.4)]' : 'bg-white/5 text-white/70 hover:bg-white/10 hover:text-white'" class="px-6 py-2.5 rounded-full text-sm transition-all duration-300 border border-white/10">Semua Wilayah</button>
            <button @click="tab = 'barat'" :class="tab === 'barat' ? 'bg-[#9acb03] text-[#0a1f12] font-bold shadow-[0_0_20px_rgba(154,203,3,0.4)]' : 'bg-white/5 text-white/70 hover:bg-white/10 hover:text-white'" class="px-6 py-2.5 rounded-full text-sm transition-all duration-300 border border-white/10">Indonesia Barat</button>
            <button @click="tab = 'tengah'" :class="tab === 'tengah' ? 'bg-[#9acb03] text-[#0a1f12] font-bold shadow-[0_0_20px_rgba(154,203,3,0.4)]' : 'bg-white/5 text-white/70 hover:bg-white/10 hover:text-white'" class="px-6 py-2.5 rounded-full text-sm transition-all duration-300 border border-white/10">Indonesia Tengah</button>
            <button @click="tab = 'timur'" :class="tab === 'timur' ? 'bg-[#9acb03] text-[#0a1f12] font-bold shadow-[0_0_20px_rgba(154,203,3,0.4)]' : 'bg-white/5 text-white/70 hover:bg-white/10 hover:text-white'" class="px-6 py-2.5 rounded-full text-sm transition-all duration-300 border border-white/10">Indonesia Timur</button>
        </div>

        {{-- Clickable city pills --}}
        <div class="flex flex-wrap justify-center gap-3 max-w-6xl mx-auto">
            @foreach(config('cities') as $key => $c)
                @php
                    $prov = $c['province'];
                    if (in_array($prov, ['Jawa Timur', 'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Sumatera Selatan', 'Sumatera Utara', 'Riau', 'Kepulauan Riau', 'Sumatera Barat', 'Banten', 'Kalimantan Barat'])) {
                        $region = 'barat';
                    } elseif (in_array($prov, ['Papua', 'Maluku', 'Papua Barat'])) {
                        $region = 'timur';
                    } else {
                        $region = 'tengah';
                    }
                @endphp
                @if(isset($waLinks) && $waLinks)
                <a href="{{ wa_link('Halo HVM Digital, saya tertarik dengan layanan ' . ($itemTitlePrefix ?? 'Jasa Website') . ' untuk wilayah ' . $c['name'] . '. Mohon informasi dan konsultasi lebih lanjut.') }}"
                   target="_blank" rel="noopener"
                   x-show="tab === 'all' || tab === '{{ $region }}'"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 scale-90"
                   x-transition:enter-end="opacity-100 scale-100"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="opacity-100 scale-100"
                   x-transition:leave-end="opacity-0 scale-90"
                   title="{{ $itemTitlePrefix ?? 'Jasa Website' }} {{ $c['name'] }} — HVM Digital"
                   class="flex items-center gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:from-[#075749] hover:to-[#9acb03] border border-white/10 hover:border-[#9acb03]/50 text-white hover:text-white text-xs md:text-sm font-medium px-4 py-2 rounded-xl transition-all duration-300 hover:shadow-[0_10px_20px_rgba(154,203,3,0.2)] hover:-translate-y-1">
                    <span class="w-2 h-2 rounded-full bg-[#25D366] shadow-[0_0_8px_#25D366]"></span>
                    {{ $c['name'] }}
                </a>
                @elseif(isset($noLinks) && $noLinks)
                <div x-show="tab === 'all' || tab === '{{ $region }}'"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 scale-90"
                   x-transition:enter-end="opacity-100 scale-100"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="opacity-100 scale-100"
                   x-transition:leave-end="opacity-0 scale-90"
                   title="{{ $itemTitlePrefix ?? 'Jasa Website' }} {{ $c['name'] }} — HVM Digital"
                   class="flex items-center gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:from-[#075749] hover:to-[#9acb03] border border-white/10 hover:border-[#9acb03]/50 text-white hover:text-white text-xs md:text-sm font-medium px-4 py-2 rounded-xl transition-all duration-300 hover:shadow-[0_10px_20px_rgba(154,203,3,0.2)] cursor-default">
                    <span class="w-2 h-2 rounded-full bg-[#9acb03] shadow-[0_0_8px_#9acb03]"></span>
                    {{ $c['name'] }}
                </div>
                @else
                <a href="{{ url($c['slug']) }}"
                   x-show="tab === 'all' || tab === '{{ $region }}'"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 scale-90"
                   x-transition:enter-end="opacity-100 scale-100"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="opacity-100 scale-100"
                   x-transition:leave-end="opacity-0 scale-90"
                   title="{{ $itemTitlePrefix ?? 'Jasa Website' }} {{ $c['name'] }} — HVM Digital"
                   class="flex items-center gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:from-[#075749] hover:to-[#9acb03] border border-white/10 hover:border-[#9acb03]/50 text-white hover:text-white text-xs md:text-sm font-medium px-4 py-2 rounded-xl transition-all duration-300 hover:shadow-[0_10px_20px_rgba(154,203,3,0.2)] hover:-translate-y-1">
                    <span class="w-2 h-2 rounded-full bg-[#9acb03] shadow-[0_0_8px_#9acb03]"></span>
                    {{ $c['name'] }}
                </a>
                @endif
            @endforeach
        </div>
    </div>
</section>
