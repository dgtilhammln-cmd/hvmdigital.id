@extends('layouts.app')
@section('content')
<main>

{{-- HERO --}}
<section class="relative pt-40 pb-16 overflow-hidden" style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);">
    <div class="absolute inset-0 opacity-[0.07]" style="background-image:linear-gradient(rgba(154,203,3,0.4) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl pointer-events-none" style="background:radial-gradient(circle,#9acb03,transparent);"></div>

    <div class="relative container mx-auto px-4 lg:px-8 max-w-4xl text-center">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-white/40 text-xs font-light mb-8 flex-wrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('articles') }}" class="hover:text-white transition-colors">Artikel</a>
            @if($article->articleCategory)
                <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                @if($article->articleCategory->parent)
                    <a href="{{ route('articles', ['kategori' => $article->articleCategory->parent->slug]) }}" class="hover:text-white transition-colors">{{ $article->articleCategory->parent->name }}</a>
                    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                @endif
                <a href="{{ route('articles', ['kategori' => $article->articleCategory->slug]) }}" class="text-[#9acb03]">{{ $article->articleCategory->name }}</a>
            @elseif($article->category)
                <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#9acb03]">{{ $article->category }}</span>
            @endif
        </nav>

        {{-- Category tag --}}
        @php $catName = $article->articleCategory?->name ?? $article->category; @endphp
        @if($catName)
        <a href="{{ route('articles', ['kategori' => $article->articleCategory?->slug ?? '']) }}"
           class="inline-flex items-center justify-center gap-1.5 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 transition-opacity hover:opacity-80 mx-auto"
           style="background:rgba(154,203,3,0.15); color:#9acb03; border:1px solid rgba(154,203,3,0.25);">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            {{ $catName }}
        </a>
        @endif

        <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-6 mx-auto">{{ $article->title }}</h1>

        @if($article->excerpt)
        <p class="text-white/60 text-base md:text-lg font-light leading-relaxed max-w-2xl mb-8 mx-auto">{{ $article->excerpt }}</p>
        @endif

        {{-- Meta + Share (Premium Glassmorphism Pill) --}}
        <div class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-10 flex-wrap px-6 md:px-8 py-4 bg-white/5 border border-white/10 rounded-3xl md:rounded-full mt-10 backdrop-blur-md mx-auto shadow-xl">
            <div class="flex flex-wrap items-center justify-center gap-4 md:gap-5 text-white/60 text-xs md:text-sm font-medium">
                <span class="flex items-center gap-1.5" title="Tanggal Publikasi">
                    <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $article->published_at?->translatedFormat('d F Y') }}
                </span>
                <span class="flex items-center gap-1.5" title="Estimasi Waktu Baca">
                    <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $article->reading_time ?? 3 }} min read
                </span>
                <span class="flex items-center gap-1.5" title="Jumlah Tayangan">
                    <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    {{ number_format($article->views) }} views
                </span>
            </div>
            
            <div class="w-full h-px md:w-px md:h-6 bg-white/10 block"></div>

            @php $eu = urlencode(url()->current()); $et = urlencode($article->title); @endphp
            <div class="flex items-center gap-3">
                <span class="text-white/40 text-xs font-semibold uppercase tracking-wider hidden sm:block mr-2">Bagikan:</span>
                <a href="https://wa.me/?text={{ $et }}%20{{ $eu }}" target="_blank" rel="noopener noreferrer"
                   class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#9acb03] flex items-center justify-center text-white hover:text-[#053d33] transition-all border border-white/10 hover:border-[#9acb03] hover:scale-110"
                   title="Share ke WhatsApp">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $eu }}" target="_blank" rel="noopener noreferrer"
                   class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#9acb03] flex items-center justify-center text-white hover:text-[#053d33] transition-all border border-white/10 hover:border-[#9acb03] hover:scale-110" title="Share ke Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <button onclick="copyArticleLink()"
                        class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#9acb03] flex items-center justify-center text-white hover:text-[#053d33] transition-all border border-white/10 hover:border-[#9acb03] hover:scale-110" title="Copy link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>



{{-- CONTENT --}}
<section class="py-16 bg-white dark:bg-[#0a1510]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-12">

                {{-- Article body --}}
                <div>
                    {{-- FEATURED IMAGE (Moved inside content column, 16:9 ratio) --}}
                    @if($article->featured_image)
                    <div class="rounded-2xl overflow-hidden mb-8 shadow-md aspect-video bg-card dark:bg-card-dark border border-theme">
                        <img src="{{ get_image_url($article->featured_image) }}"
                             alt="{{ $article->title }}"
                             width="1920" height="1080"
                             class="w-full h-full object-cover"
                             loading="eager">
                    </div>
                    @endif

                    {{-- TOC Box (Server-Side Rendered) --}}
                    @if(isset($article->toc) && count($article->toc) > 0)
                    <div id="toc-container" class="rounded-2xl p-6 mb-8 border border-[#075749]/10 dark:border-white/5 bg-[#f0fdf4] dark:bg-[#0d1f15]">
                        <p class="text-[#0a1f12] dark:text-white text-sm font-semibold tracking-widest uppercase mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Daftar Isi
                        </p>
                        <ul class="space-y-2.5 text-[15px] font-medium">
                            @foreach($article->toc as $item)
                                <li style="margin-left: {{ ($item['level'] - 2) * 1.5 }}rem;">
                                    <a href="#{{ $item['id'] }}" class="text-gray-600 dark:text-gray-400 hover:text-lime dark:hover:text-lime-light transition-colors block py-0.5">
                                        {{ $item['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="prose-hvm" id="article-content">
                        {!! $article->parsed_content ?? Str::markdown($article->content ?? '') !!}
                    </div>

                    {{-- Tags --}}
                    @if($article->meta_keywords)
                    <div class="mt-10 pt-8 border-t border-[#075749]/10 dark:border-white/5 flex flex-wrap gap-2">
                        @foreach(explode(',', $article->meta_keywords) as $kw)
                        <span class="text-xs bg-[#f0fdf4] dark:bg-[#0d1f15] border border-[#075749]/15 dark:border-[#9acb03]/15 text-[#075749] dark:text-[#9acb03] px-3 py-1 rounded-full font-light">
                            #{{ trim($kw) }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    {{-- FAQS --}}
                    @if($article->faqs && is_array($article->faqs) && count($article->faqs) > 0)
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold text-[#0a1f12] dark:text-white mb-6">Pertanyaan Sering Diajukan (FAQ)</h2>
                        <div class="space-y-4">
                            @foreach($article->faqs as $index => $faq)
                            <details class="group bg-white dark:bg-[#0d1f15] border border-[#075749]/10 dark:border-white/10 rounded-2xl overflow-hidden [&_summary::-webkit-details-marker]:hidden">
                                <summary class="flex items-center justify-between gap-4 p-5 cursor-pointer select-none">
                                    <h3 class="font-medium text-[#075749] dark:text-[#9acb03]">{{ $faq['question'] ?? '' }}</h3>
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-[#f0fdf4] dark:bg-white/5 flex items-center justify-center text-[#075749] dark:text-[#9acb03] group-open:-rotate-180 transition-transform duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </span>
                                </summary>
                                <div class="px-5 pb-5 text-gray-600 dark:text-gray-300 font-light leading-relaxed text-sm">
                                    {{ $faq['answer'] ?? '' }}
                                </div>
                            </details>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Author box --}}
                    @php
                        $faviconUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('favicon.ico');
                    @endphp
                    <div class="mt-12 p-6 rounded-2xl bg-[#f0fdf4] dark:bg-[#0d1f15] border border-[#075749]/10 dark:border-[#9acb03]/10 flex gap-4 items-start">
                        <img src="{{ $faviconUrl }}" alt="Logo HVM" class="w-12 h-12 rounded-xl object-cover shrink-0 border border-[#075749]/10 dark:border-[#9acb03]/10">
                        <div>
                            <p class="font-semibold text-[#0a1f12] dark:text-white text-sm mb-1">{{ $article->author_name ?: 'Tim HVM Digital' }}</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs font-light leading-relaxed">
                                Ditulis oleh tim konten HVM Digital — agensi One-Stop Digital Marketing & IT Solution di Surabaya. Telah membantu 200+ bisnis tumbuh secara digital.
                            </p>
                        </div>
                    </div>

                    {{-- Share bottom --}}
                    <div class="mt-8 p-5 rounded-2xl bg-[#f0fdf4] dark:bg-[#0d1f15] border border-[#075749]/10 dark:border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">Artikel ini bermanfaat? Bagikan ke rekan Anda!</p>
                        <div class="flex gap-2">
                            <a href="https://wa.me/?text={{ $et }}%20{{ $eu }}" target="_blank"
                               class="inline-flex items-center gap-2 text-xs font-medium px-4 py-2 rounded-full border border-[#075749]/20 text-[#075749] dark:text-[#9acb03] hover:bg-[#075749] hover:text-white dark:hover:bg-[#9acb03] dark:hover:text-[#053d33] transition-all">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                Bagikan WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <aside class="space-y-6">
                    {{-- CTA Box --}}
                    <div class="rounded-2xl p-6 text-center" style="background:linear-gradient(135deg,#053d33,#075749);">
                        <div class="w-10 h-10 rounded-xl bg-[#9acb03]/20 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-5 h-5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <p class="text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-2">Konsultasi Gratis</p>
                        <p class="text-white font-semibold text-sm leading-snug mb-4">Siap menerapkan strategi ini untuk bisnis Anda?</p>
                        <a href="{{ wa_link('Halo HVM Digital, saya baru membaca artikel "'.$article->title.'" dan ingin konsultasi') }}"
                           target="_blank" rel="noopener"
                           class="block w-full text-center text-[#053d33] font-semibold text-sm py-3 rounded-xl hover:scale-105 transition-transform"
                           style="background:linear-gradient(135deg,#9acb03,#b8e832);">
                            Chat Sekarang
                        </a>
                    </div>

                    {{-- Related --}}
                    @if($related->count())
                    <div class="bg-card dark:bg-card-dark rounded-2xl p-6 border border-theme shadow-sm">
                        <p class="text-fg text-xs font-bold tracking-widest uppercase mb-5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            Artikel Terkait
                        </p>
                        <div class="space-y-4">
                            @foreach($related as $rel)
                            <a href="{{ route('articles.show', $rel->slug) }}"
                               class="group flex gap-4 items-start pb-4 border-b border-theme last:border-0 last:pb-0">
                                <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 shadow-sm">
                                    @if($rel->featured_image)
                                    <img src="{{ get_image_url($rel->featured_image_thumb ?? $rel->featured_image) }}"
                                         alt="{{ $rel->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                    <div class="w-full h-full bg-brand-gradient"></div>
                                    @endif
                                </div>
                                <div class="min-w-0 pt-0.5">
                                    <h4 class="text-fg font-medium text-sm leading-snug line-clamp-2 group-hover:text-lime transition-colors duration-300">{{ $rel->title }}</h4>
                                    <p class="text-muted text-[11px] mt-1.5">{{ $rel->published_at?->translatedFormat('d F Y') }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</section>

</main>

@push('scripts')
<script>
function copyArticleLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = event.currentTarget;
        const orig = btn.innerHTML;
        btn.innerHTML = '<svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        setTimeout(() => btn.innerHTML = orig, 2000);
    });
}

</script>
@endpush

@endsection
