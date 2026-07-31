{{-- ===== PORTOFOLIO PREMIUM — Instagram Story Format 9:16 ===== --}}
@php
$portfolios = \App\Models\Portfolio::active()->take(6)->get();
$cityName = $cityName ?? null; // passed from city landing pages
$sectionTitle = $cityName
    ? "Portofolio Website di $cityName"
    : 'Portofolio Terbaru HVM Digital';
$sectionDesc = $cityName
    ? "Lihat hasil nyata website yang telah kami bangun untuk klien di $cityName dan sekitarnya."
    : 'Hasil nyata website profesional yang telah kami bangun untuk klien di seluruh Indonesia.';
@endphp

@if($portfolios->count())
<section class="py-16 md:py-20 bg-[#f0fdf4] dark:bg-[#061009]" id="portofolio"
         itemscope itemtype="https://schema.org/ItemList">
    <meta itemprop="name" content="{{ $sectionTitle }}">

    <div class="container mx-auto px-4 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12">
            <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Hasil Nyata</span>
            <h2 class="text-2xl md:text-3xl font-bold text-[#0a1f12] dark:text-white mb-3">
                {{ $sectionTitle }}
            </h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-light max-w-xl mx-auto">
                {{ $sectionDesc }}
            </p>
        </div>

        {{-- Story-format grid (9:16 aspect ratio) --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5"
             itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            @foreach($portfolios as $i => $p)
            <article class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-1.5"
                     itemprop="item" itemscope itemtype="https://schema.org/CreativeWork"
                     style="aspect-ratio: 9/16;">
                <meta itemprop="position" content="{{ $i + 1 }}">
                <meta itemprop="name" content="{{ $p->title }}">

                {{-- Image --}}
                <img src="{{ asset($p->featured_image_thumb ?: $p->featured_image) }}"
                     alt="{{ $p->title }} — Portofolio HVM Digital{{ $p->city ? ' '.$p->city : '' }}"
                     title="{{ $p->title }}"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                     loading="lazy"
                     width="360" height="640"
                     onerror="this.src='{{ asset('images/portfolio/portoweb1.webp') }}'">

                {{-- Gradient — ultra-dark at bottom so text always readable --}}
                <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.6) 40%,rgba(0,0,0,0.1) 70%,transparent 100%);"></div>

                {{-- City badge only — top-left --}}
                @if($p->city)
                <div class="absolute top-3 left-3 z-10">
                    <span class="inline-flex items-center gap-1 text-[10px] font-semibold bg-[#9acb03] text-[#053d33] px-2.5 py-1 rounded-full leading-none">
                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        {{ $p->city }}
                    </span>
                </div>
                @endif

                {{-- Bottom content --}}
                <div class="absolute bottom-0 left-0 right-0 p-4 z-10">
                    {{-- Client name — always visible --}}
                    @if($p->client)
                    <p class="text-[#9acb03] text-[10px] font-bold uppercase tracking-wider mb-1.5">
                        {{ $p->client }}
                    </p>
                    @endif
                    {{-- Title — always visible --}}
                    <h3 class="font-bold text-white text-sm leading-snug mb-2 line-clamp-2"
                        itemprop="description">
                        {{ $p->title }}
                    </h3>
                    {{-- Short description — always visible --}}
                    @if($p->description)
                    <p class="text-white/70 text-[11px] font-light leading-relaxed line-clamp-2 mb-3">
                        {{ Str::limit($p->description, 72) }}
                    </p>
                    @endif
                    {{-- CTA — hover only --}}
                    @if($p->url)
                    <a href="{{ wa_link('Halo HVM Digital, saya tertarik dengan portofolio: '.$p->title) }}"
                       target="_blank" rel="noopener"
                       class="wa-btn inline-flex items-center gap-1.5 text-[11px] font-semibold
                              bg-[#9acb03] text-[#053d33] px-3.5 py-1.5 rounded-full
                              opacity-0 group-hover:opacity-100 translate-y-1 group-hover:translate-y-0
                              transition-all duration-300 hover:bg-[#b8e832]">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Tanya Project Ini
                    </a>
                    @endif
                </div>
            </article>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-10">
            <p class="text-gray-400 dark:text-gray-500 text-sm mb-4">
                Lihat lebih banyak hasil kerja kami — <span class="text-[#075749] dark:text-[#9acb03] font-medium">100+ klien</span> telah mempercayai HVM Digital.
            </p>
            <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi website seperti portofolio Anda') }}"
               target="_blank" rel="noopener"
               class="wa-btn inline-flex items-center gap-2.5 text-sm font-semibold
                      bg-gradient-to-r from-[#075749] to-[#0a6d58]
                      text-white px-8 py-3.5 rounded-full
                      hover:shadow-xl hover:scale-105 hover:from-[#9acb03] hover:to-[#b8e832] hover:text-[#053d33]
                      transition-all duration-300 shadow-md">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Diskusi Project Anda Sekarang
            </a>
        </div>
    </div>
</section>
@endif
