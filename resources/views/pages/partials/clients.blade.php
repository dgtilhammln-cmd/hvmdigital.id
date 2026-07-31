{{-- Client Logo Ticker + Diliput Media --}}

{{-- === LOGO KLIEN === --}}
@php
// Load up to 8 client slots from settings
$clientLogos = [];
for ($i = 1; $i <= 8; $i++) {
    $logo = setting("client_{$i}_logo");
    if ($logo) {
        $clientLogos[] = [
            'logo' => $logo,
            'alt'  => setting("client_{$i}_alt", "Klien HVM Digital"),
        ];
    }
}
// Fallback placeholder if no logos set yet
if (empty($clientLogos)) {
    $clientLogos = [
        ['logo' => null, 'alt' => 'Klien HVM Digital — Jasa Website Profesional'],
        ['logo' => null, 'alt' => 'Klien HVM Digital — Digital Marketing'],
        ['logo' => null, 'alt' => 'Klien HVM Digital — SEO Surabaya'],
        ['logo' => null, 'alt' => 'Klien HVM Digital — Pembuatan Website'],
        ['logo' => null, 'alt' => 'Klien HVM Digital — Toko Online'],
    ];
}
@endphp

@if(count(array_filter(array_column($clientLogos, 'logo'))) > 0)
<section class="py-14 bg-white dark:bg-[#0a1510] border-y border-[#075749]/10 dark:border-[#9acb03]/10 overflow-hidden"
         aria-label="Klien Terpercaya HVM Digital">
    <p class="text-center text-xs text-gray-400 font-light tracking-widest uppercase mb-8">Dipercaya oleh berbagai bisnis terkemuka</p>
    <div class="overflow-hidden">
        <div class="ticker-track">
            @foreach(array_merge($clientLogos, $clientLogos) as $c)
            @if($c['logo'])
            <div class="flex-shrink-0 mx-10 flex items-center opacity-60 hover:opacity-100 transition-opacity duration-300">
                <img src="{{ get_image_url($c['logo']) }}"
                     alt="{{ $c['alt'] }}"
                     class="h-10 w-auto max-w-[140px] object-contain filter grayscale hover:grayscale-0 transition-all duration-300"
                     loading="lazy"
                     width="140" height="40">
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- === DILIPUT & DIAKUI OLEH === --}}
@php
// Load up to 5 media mention slots from settings
$mentions = [];
for ($i = 1; $i <= 5; $i++) {
    $logo = setting("mention_{$i}_logo");
    if ($logo) {
        $mentions[] = [
            'logo' => $logo,
            'alt'  => setting("mention_{$i}_alt", "HVM Digital Diliput Media"),
            'link' => setting("mention_{$i}_link", '#'),
        ];
    }
}
@endphp

@if(count($mentions) > 0)
<section class="py-10 bg-gradient-to-r from-[#075749] to-[#9acb03] border-y border-white/5" aria-label="Media yang Meliput HVM Digital">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-14">
            <p class="text-xs font-semibold text-white/80 tracking-widest uppercase whitespace-nowrap">Diliput &amp; Diakui oleh</p>
            <div class="flex flex-wrap items-center justify-center gap-10">
                @foreach($mentions as $mention)
                <a href="{{ $mention['link'] }}"
                   target="{{ $mention['link'] !== '#' ? '_blank' : '_self' }}"
                   rel="{{ $mention['link'] !== '#' ? 'noopener noreferrer' : '' }}"
                   class="block opacity-80 hover:opacity-100 transition-opacity duration-300"
                   title="{{ $mention['alt'] }}">
                    <img src="{{ get_image_url($mention['logo']) }}"
                         alt="{{ $mention['alt'] }}"
                         class="h-10 w-auto max-w-[120px] object-contain"
                         loading="lazy"
                         width="120" height="40">
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
