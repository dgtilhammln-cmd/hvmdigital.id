{{-- Reusable article card — brand colors only, no external color palette --}}
<article class="group bg-white dark:bg-[#0d1f15] rounded-2xl overflow-hidden border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/40 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

    {{-- Thumbnail --}}
    <a href="{{ route('articles.show', $article->slug) }}" class="block aspect-video overflow-hidden relative shrink-0">
        @if($article->featured_image)
        <img src="{{ get_image_url($article->featured_image_thumb ?? $article->featured_image) }}"
             alt="{{ $article->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
             loading="lazy">
        @else
        <div class="w-full h-full flex items-center justify-center"
             style="background:linear-gradient(135deg,#075749,#0a6d58);">
            <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        @endif

        {{-- Category badge — brand theme only --}}
        @if($article->articleCategory)
        <div class="absolute top-3 left-3 z-10">
            <a href="{{ route('articles', ['kategori' => $article->articleCategory->slug]) }}"
               onclick="event.stopPropagation()"
               class="text-[10px] font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm transition-opacity hover:opacity-90"
               style="background:rgba(5,61,51,0.85); color:#9acb03; border:1px solid rgba(154,203,3,0.3);">
                {{ $article->articleCategory->name }}
            </a>
        </div>
        @elseif($article->category)
        <div class="absolute top-3 left-3 z-10">
            <span class="text-[10px] font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm"
                  style="background:rgba(5,61,51,0.85); color:#9acb03; border:1px solid rgba(154,203,3,0.3);">
                {{ $article->category }}
            </span>
        </div>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-5 flex flex-col flex-1">
        {{-- Meta --}}
        <div class="flex items-center gap-3 mb-3 text-xs text-gray-400 dark:text-gray-500 font-light">
            <span class="flex items-center gap-1">
                <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $article->published_at?->format('d M Y') }}
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                {{ number_format($article->views) }}
            </span>
        </div>

        {{-- Title --}}
        <h2 class="font-semibold text-[#0a1f12] dark:text-white text-base leading-snug mb-2.5 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors flex-1">
            <a href="{{ route('articles.show', $article->slug) }}" class="line-clamp-2">{{ $article->title }}</a>
        </h2>

        @if($article->excerpt)
        <p class="text-gray-500 dark:text-gray-400 text-xs font-light line-clamp-2 leading-relaxed mb-4">{{ $article->excerpt }}</p>
        @endif

        <a href="{{ route('articles.show', $article->slug) }}"
           class="inline-flex items-center gap-1.5 text-[#075749] dark:text-[#9acb03] text-sm font-medium mt-auto hover:gap-3 transition-all">
            Baca Selengkapnya
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</article>
