{{-- PREMIUM PRICING — Horizontal 4-column, SVG icons --}}
@php $kota = isset($cityConfig) ? $cityConfig['name'] : 'Seluruh Indonesia'; @endphp
<section class="py-16 md:py-20 bg-[#f0fdf4] dark:bg-[#061009]" id="harga-website">
<div class="container mx-auto px-4 lg:px-8">
    <div class="text-center mb-12">
        <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Harga Transparan</span>
        <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-3">Paket Harga Website {{ $kota }}</h2>
        <p class="text-gray-500 dark:text-gray-400 text-sm font-light max-w-xl mx-auto">Harga sudah termasuk domain, hosting, SSL, dan support. Tidak ada biaya tersembunyi.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 pt-8 pb-4 items-stretch">

    @php
        $packages = \App\Models\PricingPackage::orderBy('order')->get();
    @endphp

    @forelse($packages as $pkg)
        @php
            $isCustom = $pkg->theme_style === 'custom';
            $isPro = $pkg->theme_style === 'professional';
            
            // Base classes
            $containerClass = "flex-1 min-w-[220px] flex flex-col rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative ";
            
            if ($isCustom) {
                $containerClass .= "border border-[#075749]/15 dark:border-[#9acb03]/10 bg-gradient-to-b from-[#053d33] to-[#075749]";
                $titleClass = "text-[#9acb03]";
                $priceSubClass = "text-white/50";
                $priceClass = "text-white";
                $descClass = "text-white/50";
                $dividerClass = "border-white/10";
                $iconBgClass = "bg-white/10";
                $liTextClass = "text-white/80";
                $btnClass = "bg-[#9acb03] text-[#053d33] hover:bg-[#b8e832] shadow-lg border-transparent";
            } else if ($isPro) {
                $containerClass .= "border-2 border-[#9acb03] bg-white dark:bg-[#0d1f15] shadow-2xl shadow-[#9acb03]/10";
                $titleClass = "text-[#9acb03] mt-3";
                $priceSubClass = "text-gray-400";
                $priceClass = "text-[#0a1f12] dark:text-white";
                $descClass = "text-gray-400";
                $dividerClass = "border-[#9acb03]/20";
                $iconBgClass = "bg-[#9acb03]/15";
                $liTextClass = "text-gray-600 dark:text-gray-300";
                $btnClass = "bg-[#9acb03] text-[#053d33] hover:bg-[#b8e832] shadow-lg border-transparent";
            } else {
                // Starter / Enterprise
                $containerClass .= "border border-[#075749]/15 dark:border-[#9acb03]/10 bg-white dark:bg-[#0d1f15]";
                $titleClass = "text-[#9acb03]";
                $priceSubClass = "text-gray-400";
                $priceClass = "text-[#0a1f12] dark:text-white";
                $descClass = "text-gray-400";
                $dividerClass = "border-[#075749]/10 dark:border-[#9acb03]/10";
                $iconBgClass = "bg-[#9acb03]/10";
                $liTextClass = "text-gray-600 dark:text-gray-300";
                $btnClass = "border border-[#075749]/30 dark:border-[#9acb03]/20 text-[#075749] dark:text-[#9acb03] hover:bg-[#075749]/5";
            }
        @endphp

        <div class="{{ $containerClass }}">
            @if($isPro)
            <div class="absolute -top-px left-0 right-0 h-1 bg-gradient-to-r from-[#9acb03] to-[#b8e832] rounded-t-2xl"></div>
            @endif
            
            @if($pkg->is_popular)
            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-[#9acb03] text-[#053d33] text-[10px] font-bold px-3 py-1 rounded-full whitespace-nowrap tracking-wide uppercase shadow-md z-10">Paling Populer</div>
            @endif

            <p class="{{ $titleClass }} text-[10px] font-bold uppercase tracking-widest mb-2">{{ $pkg->name }}</p>
            <div class="mb-1"><span class="text-[11px] {{ $priceSubClass }} font-light block">{{ $isCustom ? 'Harga' : 'Mulai dari' }}</span><span class="text-3xl font-black {{ $priceClass }} leading-tight">{{ $pkg->price }}</span></div>
            <p class="{{ $descClass }} text-xs font-light mt-2 mb-5 leading-relaxed">{{ $pkg->description }}</p>
            <div class="border-t {{ $dividerClass }} mb-5"></div>
            
            <ul class="space-y-3 flex-1 mb-6">
                @if(is_array($pkg->features))
                    @foreach($pkg->features as $feat)
                    <li class="flex items-center gap-2.5 text-xs {{ $liTextClass }}">
                        <div class="w-6 h-6 rounded-lg {{ $iconBgClass }} flex items-center justify-center shrink-0">
                            {{-- Universal check icon --}}
                            <svg class="w-3.5 h-3.5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $feat }}
                    </li>
                    @endforeach
                @endif
            </ul>
            
            @php
                $waText = $pkg->wa_message ?: "Halo HVM Digital, saya tertarik paket {$pkg->name} untuk website di {$kota}";
            @endphp
            <a href="{{ wa_link($waText) }}" target="_blank" rel="noopener" onclick="trackWaClick('pricing-{{ Str::slug($pkg->name) }}')" class="wa-btn block w-full text-center font-semibold py-3 rounded-xl text-sm transition-all {{ $btnClass }}">
                {{ $pkg->button_text }}
            </a>
        </div>
    @empty
        <div class="p-8 text-center w-full text-gray-500 text-sm">Paket harga belum tersedia.</div>
    @endforelse

    </div>{{-- /grid --}}
    <p class="text-center text-gray-400 text-xs mt-6 font-light">Harga dapat menyesuaikan kebutuhan spesifik bisnis Anda di {{ $kota }}. Konsultasi gratis untuk estimasi akurat.</p>
</div>
</section>
