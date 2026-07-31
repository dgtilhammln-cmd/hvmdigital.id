<section class="relative min-h-[90vh] flex items-center overflow-hidden pt-20" style="background: linear-gradient(135deg, #053d33 0%, #075749 55%, #0a6d58 100%);">
    {{-- Grid overlay --}}
    <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image:linear-gradient(rgba(154,203,3,0.4) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4) 1px,transparent 1px);background-size:48px 48px;"></div>

    {{-- Premium City Icon — Right Column (desktop only) --}}
    <div class="absolute inset-y-0 right-0 w-1/2 hidden md:flex items-center justify-center pointer-events-none overflow-hidden pr-0 lg:pr-12">
        {{-- Multi-layer glow --}}
        <div class="absolute w-[450px] h-[450px] rounded-full opacity-25 blur-3xl -right-10"
             style="background: radial-gradient(circle at center, #9acb03 0%, #4a8a00 40%, transparent 70%);"></div>
        <div class="absolute w-[300px] h-[300px] rounded-full opacity-15 blur-xl right-10"
             style="background: radial-gradient(circle, #b8e832 0%, transparent 65%);"></div>
        {{-- City landmark icon / Hero Image --}}
        @php
            $heroImgUrl = null;
            if (!empty($landing?->featured_image)) {
                $heroImgUrl = get_image_url($landing->featured_image);
            } else {
                $defaultSlide = \App\Models\HeroSlide::where('is_active', true)->orderBy('order')->first();
                $heroImgUrl = $defaultSlide?->image ? get_image_url($defaultSlide->image) : (setting('hero_image') ? get_image_url(setting('hero_image')) : asset('images/logohvm.png'));
            }
        @endphp
        <img src="{{ $heroImgUrl }}"
             alt="Landmark {{ $cityConfig['name'] }} - HVM Digital Jasa Website"
             class="relative z-10 max-w-[80%] max-h-[320px] md:max-h-[360px] lg:max-h-[400px] xl:max-h-[450px] w-auto object-contain object-center select-none pointer-events-none"
             style="filter: drop-shadow(0 0 80px rgba(154,203,3,0.45)) drop-shadow(0 30px 60px rgba(0,0,0,0.6));"
             loading="eager">
    </div>

    {{-- Content — Left Side --}}
    <div class="relative z-10 container mx-auto px-4 lg:px-8 py-12 md:py-16">
        <div class="md:w-1/2 xl:w-[52%] lg:pl-6 xl:pl-10">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-white/40 text-xs font-light mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#9acb03]">Jasa Website {{ $cityConfig['name'] }}</span>
            </nav>

            {{-- HQ Badge --}}
            @if(!empty($cityConfig['is_hq']))
            <div class="inline-flex items-center gap-2 border border-[#9acb03]/40 bg-[#9acb03]/10 rounded-full px-4 py-1.5 mb-5">
                <span class="w-2 h-2 bg-[#9acb03] rounded-full animate-pulse"></span>
                <span class="text-[#9acb03] text-xs font-medium">Kantor Pusat HVM Digital</span>
            </div>
            @endif

            {{-- H1 --}}
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-[2.5rem] font-bold text-white leading-[1.18] mb-4">
                {{ $landing?->hero_title ?? $cityConfig['h1'] }}
            </h1>

            {{-- Subtitle --}}
            <p class="text-white/65 text-sm md:text-base font-light leading-relaxed mb-6 max-w-lg">
                @if($landing?->hero_subtitle)
                    {{ $landing->hero_subtitle }}
                @else
                    HVM Digital hadir di <strong class="text-white font-semibold">{{ $cityConfig['name'] }}</strong> — solusi website &amp; digital marketing profesional agar bisnis Anda ditemukan lebih banyak pelanggan.
                @endif
            </p>

            {{-- CTA Buttons & Rating Avatars Container --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mt-4">
                @php $waHero = 'https://wa.me/'.setting('whatsapp','6285179982373').'?text='.urlencode('Halo HVM Digital, saya butuh jasa website di '.$cityConfig['name']); @endphp
                <a href="{{ $waHero }}" target="_blank" rel="noopener" onclick="trackWaClick('landing-hero')"
                   class="wa-btn inline-flex items-center justify-center gap-2 font-semibold px-7 py-4 rounded-full text-white hover:scale-105 active:scale-95 transition-all shadow-xl text-sm md:text-base whitespace-nowrap"
                   style="background: linear-gradient(135deg, #075749, #9acb03); box-shadow: 0 8px 32px rgba(7,87,73,0.35);">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Konsultasi Gratis — {{ $cityConfig['name'] }}
                </a>

                {{-- Avatars & Stars (Connected to Homepage Slide) --}}
                @php $slide = \App\Models\HeroSlide::where('is_active', true)->orderBy('order')->first(); @endphp
                @if($slide && ($slide->rating_text || $slide->avatar_1 || $slide->avatar_2 || $slide->avatar_3))
                <div class="flex flex-col gap-1.5 ml-0 sm:ml-2 border-l-0 sm:border-l-2 sm:border-white/15 sm:pl-6">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-[#075749] object-cover bg-white/10" src="{{ $slide->avatar_1 ? get_image_url($slide->avatar_1) : 'https://i.pravatar.cc/100?img=1' }}" alt="Client">
                        <img class="w-10 h-10 rounded-full border-2 border-[#075749] object-cover bg-white/10" src="{{ $slide->avatar_2 ? get_image_url($slide->avatar_2) : 'https://i.pravatar.cc/100?img=2' }}" alt="Client">
                        <img class="w-10 h-10 rounded-full border-2 border-[#075749] object-cover bg-white/10" src="{{ $slide->avatar_3 ? get_image_url($slide->avatar_3) : 'https://i.pravatar.cc/100?img=3' }}" alt="Client">
                    </div>
                    <div class="text-xs font-medium text-white/80">
                        <div class="flex items-center gap-1 text-yellow-400 mb-0.5">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= ($slide->stars ?? 5))
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @else
                                    <svg class="w-3 h-3 text-white/20" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endif
                            @endfor
                        </div>
                        <span>{!! str_replace(['900+', '100+'], ['<span class="text-[#9acb03] font-bold">100+</span>', '<span class="text-[#9acb03] font-bold">100+</span>'], e($slide->rating_text ?: '100+ bisnis bergabung')) !!}</span>
                    </div>
                </div>
                @endif
            </div>

            {{-- Trust badges (Restored without Garansi Revisi 3x) --}}
            <div class="flex flex-wrap gap-x-4 gap-y-2 mt-8 pt-6 border-t border-white/10">
                @foreach(['Konsultasi Gratis','Support 1 Tahun','Mobile Friendly','SEO Optimized'] as $badge)
                <div class="flex items-center gap-1.5 text-white/55 text-xs">
                    <svg class="w-3.5 h-3.5 text-[#9acb03] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ $badge }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Intro + nearby chips --}}
<section class="py-10 md:py-14 bg-white dark:bg-[#0a1510]">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl">
        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold mb-4 text-[#0a1f12] dark:text-white">
            Jasa Pembuatan Website di {{ $cityConfig['name'] }}
        </h2>
        <div class="prose-hvm text-sm md:text-base">
            @if($landing?->content_intro)
                {!! nl2br(e($landing->content_intro)) !!}
            @else
                <p>HVM Digital adalah mitra digital terpercaya untuk bisnis Anda di <strong>{{ $cityConfig['name'] }}</strong>. Dengan pengalaman lebih dari 5 tahun, lebih dari 200 klien puas, dan tim yang berpengalaman, kami siap membangun kehadiran online bisnis Anda di {{ $cityConfig['name'] }} dengan standar premium.</p>
            @endif
        </div>
        @if(!empty($cityConfig['nearby']))
        <div class="mt-5 p-4 md:p-5 rounded-2xl bg-[#f0fdf4] dark:bg-[#111d16] border border-[#075749]/10 dark:border-[#9acb03]/10">
            <p class="text-[#075749] dark:text-[#9acb03] font-semibold text-xs mb-3 uppercase tracking-widest">Melayani Area:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($cityConfig['nearby'] as $area)
                <span class="bg-white dark:bg-[#1a2e1e] border border-[#075749]/15 dark:border-[#9acb03]/15 text-gray-500 dark:text-gray-400 text-xs font-light px-3 py-1.5 rounded-full">{{ $area }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
