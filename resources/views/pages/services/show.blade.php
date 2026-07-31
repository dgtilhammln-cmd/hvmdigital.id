@extends('layouts.app')
@section('content')

@php
$ill = [
'pembuatan-website'                   => ['label'=>'Website Builder',   'anim'=>'website'],
'jasa-pembuatan-website'              => ['label'=>'Website Builder',   'anim'=>'website'],
'jasa-pembuatan-website-profesional'  => ['label'=>'Website Builder',   'anim'=>'website'],
'seo-sem'                             => ['label'=>'SEO & SEM',         'anim'=>'seo'],
'jasa-optimasi-seo-halaman-1'         => ['label'=>'SEO Ranking',       'anim'=>'seo'],
'search-engine-optimization-seo'      => ['label'=>'SEO Ranking',       'anim'=>'seo'],
'jasa-generative-engine-optimization' => ['label'=>'AI Engine',         'anim'=>'geo'],
'generative-engine-optimization-geo'  => ['label'=>'AI Engine',         'anim'=>'geo'],
'aplikasi-custom-it-solution'         => ['label'=>'IT Solution',       'anim'=>'app'],
'jasa-pembuatan-aplikasi-mobile'      => ['label'=>'Mobile App',        'anim'=>'app'],
'desain-grafis-branding'              => ['label'=>'Brand Design',      'anim'=>'brand'],
'jasa-desain-branding-perusahaan'     => ['label'=>'Brand Design',      'anim'=>'brand'],
'desain-branding-perusahaan'          => ['label'=>'Brand Design',      'anim'=>'brand'],
'content-creator'                     => ['label'=>'Content Studio',    'anim'=>'content'],
'social-media-management'             => ['label'=>'Social Media',      'anim'=>'social'],
'digital-advertising'                 => ['label'=>'Digital Ads',       'anim'=>'ads'],
'jasa-digital-advertising'            => ['label'=>'Digital Ads',       'anim'=>'ads'],
'digital-ads-google-meta-ads'         => ['label'=>'Digital Ads',       'anim'=>'ads'],
];
$cfg = $ill[$service->slug] ?? ['label'=>'HVM Digital','anim'=>'default'];
$brandColor = '#9acb03';
@endphp

{{-- HERO --}}
<section class="relative min-h-[92vh] flex items-center overflow-hidden pt-36"
         style="background:linear-gradient(135deg,#053d33 0%,#075749 55%,#0a6d58 100%);">
    <div class="absolute inset-0 opacity-[0.07] pointer-events-none"
         style="background-image:linear-gradient(rgba(154,203,3,0.4)1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4)1px,transparent 1px);background-size:48px 48px;"></div>

    {{-- Animated illustration — right side --}}
    <div class="absolute inset-y-0 right-0 w-[44%] hidden md:flex items-center justify-center pointer-events-none overflow-hidden">
        <div class="absolute w-[460px] h-[460px] rounded-full opacity-20 blur-3xl"
             style="background:radial-gradient(circle,{{ $brandColor }} 0%,transparent 70%);"></div>
        <div class="relative z-10 w-64 lg:w-72 xl:w-80 mx-auto" id="svc-illustration">
            @include('pages.services.partials.illustration-'.$cfg['anim'])
        </div>
    </div>

    {{-- Left content --}}
    <div class="relative z-10 container mx-auto px-4 lg:px-8 py-14">
        <div class="md:w-[52%]">
            <nav class="flex items-center gap-2 text-white/40 text-xs font-light mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 11h1v6a1 1 0 001 1h4v-4h2v4h4a1 1 0 001-1v-6h1a1 1 0 00.707-1.707l-7-7z"/></svg>
                    Beranda
                </a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('services') }}" class="hover:text-white transition-colors">Layanan</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span style="color:{{ $brandColor }}">{{ $service->name }}</span>
            </nav>

            <div class="inline-flex items-center gap-2 border border-[#9acb03]/40 bg-[#9acb03]/10 rounded-full px-4 py-1.5 mb-5">
                <span class="w-2 h-2 rounded-full animate-pulse bg-[#9acb03]"></span>
                <span class="text-xs font-medium text-[#9acb03]">{{ $cfg['label'] }}</span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-[1.1] mb-5">
                {{ $service->name }} <span class="text-[#9acb03]">Profesional</span>
            </h1>
            <p class="text-white/60 text-base md:text-lg font-light leading-relaxed mb-8 max-w-lg">
                {{ $service->short_description }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi layanan '.$service->name) }}"
                   target="_blank" rel="noopener"
                   class="w-full sm:w-auto justify-center wa-btn inline-flex items-center gap-2 font-semibold px-7 py-3.5 rounded-full text-white hover:scale-105 transition-all shadow-lg"
                   style="background:linear-gradient(135deg,#075749,#9acb03);">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Konsultasi Gratis
                </a>
                <a href="{{ route('services') }}"
                   class="w-full sm:w-auto justify-center inline-flex items-center gap-2 border border-white/25 text-white/80 font-light px-7 py-3.5 rounded-full hover:bg-white/10 transition-all text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Semua Layanan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- DESCRIPTION --}}
@if($service->description)
<section class="py-16 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl">
        <div class="bg-white dark:bg-[#0d1f15] rounded-2xl p-8 border border-[#075749]/10 dark:border-[#9acb03]/10 mb-8">
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-sm">{!! nl2br(e($service->description)) !!}</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach([['<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>','Tim berpengalaman dengan portofolio nyata'],['<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>','Timeline transparan & milestone jelas'],['<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>','Melayani seluruh Indonesia secara online'],['<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>','Support teknis & garansi responsif']] as [$icon,$txt])
            <div class="flex items-start gap-3.5 bg-white dark:bg-[#0d1f15] rounded-xl p-5 border border-[#075749]/10 dark:border-[#9acb03]/10">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15">
                    <svg class="w-5 h-5 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icon !!}</svg>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-300 font-light leading-snug pt-1.5">{{ $txt }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- WEBSITE SPECIAL EDUCATION SECTIONS --}}
@if(in_array($service->slug, ['pembuatan-website', 'jasa-pembuatan-website', 'jasa-pembuatan-website-profesional']))
@include('pages.services.partials.website-education')
@endif

{{-- CLIENTS (before pricing for website builder) --}}
@if(in_array($service->slug, ['pembuatan-website', 'jasa-pembuatan-website', 'jasa-pembuatan-website-profesional']))
@include('pages.partials.clients')
@endif

{{-- PRICING --}}
@if(in_array($service->slug, ['pembuatan-website', 'jasa-pembuatan-website', 'jasa-pembuatan-website-profesional']))
@include('pages.landing.partials.city-pricing')
@endif

{{-- PORTFOLIO --}}
@if(in_array($service->slug, ['pembuatan-website', 'jasa-pembuatan-website', 'jasa-pembuatan-website-profesional']))
@include('pages.partials.portfolio-grid')
@endif

{{-- AREA (website only) --}}
@if(in_array($service->slug, ['pembuatan-website', 'jasa-pembuatan-website', 'jasa-pembuatan-website-profesional']))
@include('pages.partials.map', [
    'subTitle' => 'Coverage Area',
    'mainTitle' => 'Jasa Website Seluruh Indonesia'
])
@endif

{{-- FAQs --}}
@if($faqs->count())
<section class="py-20 lg:py-24 bg-[#f0fdf4] dark:bg-[#061009] border-t border-gray-100 dark:border-white/5">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl">
        <div class="text-center mb-12">
            <span class="inline-block text-[#075749] dark:text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Tanya Jawab</span>
            <h2 class="text-3xl font-bold text-[#0a1f12] dark:text-white leading-tight">
                Pertanyaan Umum Seputar {{ $service->name }}
            </h2>
        </div>

        <div class="space-y-4">
            @foreach($faqs as $faq)
            <div x-data="{ open: false }" 
                 class="bg-white dark:bg-[#0d1f15] border border-gray-100 dark:border-white/5 rounded-2xl overflow-hidden transition-all duration-300" 
                 :class="open ? 'shadow-md border-[#075749]/30 dark:border-[#9acb03]/30' : 'hover:border-gray-200 dark:hover:border-white/10'">
                <button @click="open = !open" class="w-full px-6 py-5 flex items-center justify-between gap-4 text-left focus:outline-none">
                    <span class="font-bold text-[#0a1f12] dark:text-white text-base md:text-lg pr-4">{{ $faq->question }}</span>
                    <span class="w-8 h-8 shrink-0 flex items-center justify-center rounded-full bg-gray-50 dark:bg-white/5 text-[#075749] dark:text-[#9acb03] transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </button>
                <div x-show="open" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-white/60 font-light leading-relaxed max-w-none text-sm md:text-base prose-hvm">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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

{{-- Other services --}}
<section class="py-14 bg-white dark:bg-[#0a1510]">
    <div class="container mx-auto px-4 lg:px-8">
        <p class="text-center text-sm text-gray-400 dark:text-gray-500 mb-6 font-light">Layanan lain HVM Digital</p>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach(\App\Models\Service::active()->where('slug','!=',$service->slug)->take(7)->get() as $o)
            <a href="{{ route('services.show',$o) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#f0fdf4] dark:bg-[#0d1f15] border border-[#075749]/15 dark:border-[#9acb03]/15 text-[#075749] dark:text-[#9acb03] text-sm font-medium hover:border-[#9acb03]/50 hover:shadow-md hover:-translate-y-0.5 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                {{ $o->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- CLIENTS & SOCIAL PROOF --}}
@if(!in_array($service->slug, ['pembuatan-website', 'jasa-pembuatan-website', 'jasa-pembuatan-website-profesional']))
@include('pages.partials.clients')
@endif

{{-- CTA --}}
<section class="py-16" style="background:linear-gradient(135deg,#075749,#9acb03);">
    <div class="container mx-auto px-4 lg:px-8 text-center max-w-xl">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Tertarik dengan {{ $service->name }}?</h2>
        <p class="text-white/75 font-light mb-7 text-sm">Konsultasi gratis — tidak ada komitmen, tidak ada tekanan.</p>
        <a href="{{ wa_link('Halo HVM Digital, saya ingin konsultasi layanan '.$service->name) }}" target="_blank" rel="noopener"
           class="wa-btn inline-flex items-center gap-3 bg-white text-[#075749] font-bold px-10 py-4 rounded-full hover:scale-105 hover:shadow-2xl transition-all">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            Mulai Konsultasi Gratis
        </a>
    </div>
</section>
@endsection
