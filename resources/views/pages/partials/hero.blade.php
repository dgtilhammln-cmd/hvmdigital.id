{{-- Hero Section — Dynamic Slider (Left/Right Layout) --}}
@php
    // Fallback if no slides exist
    if(!isset($hero_slides) || $hero_slides->isEmpty()) {
        $hero_slides = collect([(object)[
            'headline' => 'Growth With HVM Digital',
            'subheadline' => 'HVM Digital secara terus menerus menghadirkan inovasi, menciptakan website yang dipersonalisasi & strategi pemasaran yang menghasilkan konversi tinggi untuk bisnis Anda.',
            'button_text' => 'Konsultasi Gratis Sekarang',
            'button_link' => '',
            'image' => setting('hero_image') ?? '',
            'feature_1' => null,
            'feature_2' => null,
            'feature_3' => null,
            'avatar_1' => null,
            'avatar_2' => null,
            'avatar_3' => null,
            'rating_text' => null,
            'stars' => 5
        ]]);
    }
@endphp

<section id="hero" class="relative pt-28 pb-12 md:pt-32 md:pb-16 overflow-hidden bg-gradient-to-b from-[#f8fdfa] to-white dark:from-[#0a1f12] dark:to-[#061009] min-h-screen flex items-center"
         x-data="{ 
            currentSlide: 0, 
            totalSlides: {{ $hero_slides->count() }},
            init() {
                if (this.totalSlides > 1) {
                    setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                    }, 5500);
                }
            }
         }">
    
    {{-- Grid Background & Glow Effects --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] md:w-[600px] md:h-[600px] bg-[#9acb03]/10 dark:bg-[#9acb03]/5 rounded-full blur-[100px] md:blur-[150px] pointer-events-none translate-x-1/3 -translate-y-1/4"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] md:w-[600px] md:h-[600px] bg-[#075749]/5 dark:bg-[#075749]/20 rounded-full blur-[100px] md:blur-[150px] pointer-events-none -translate-x-1/3 translate-y-1/4"></div>
    <div class="absolute inset-0 opacity-40 dark:opacity-20 pointer-events-none" style="background-image: linear-gradient(rgba(154,203,3,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(154,203,3,0.1) 1px, transparent 1px); background-size: 60px 60px; background-position: center;"></div>
    
    <div class="relative z-10 container mx-auto px-4 w-full">
        
        <div class="relative w-full min-h-[450px] md:h-[450px] lg:h-[450px] xl:h-[550px] flex items-center overflow-hidden">
            @foreach($hero_slides as $index => $slide)
                <div class="absolute inset-0 w-full h-full flex flex-col md:flex-row items-center justify-between gap-8 py-4 md:py-6"
                     x-show="currentSlide === {{ $index }}"
                     x-transition:enter="transition-transform duration-[1200ms] ease-[cubic-bezier(0.25,1,0.5,1)] absolute"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition-transform duration-[1200ms] ease-[cubic-bezier(0.25,1,0.5,1)] absolute"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full">
                    
                    {{-- Text Content (Left Side) --}}
                    <div class="w-full md:w-1/2 text-left flex flex-col justify-center h-full pt-6 md:pt-0">
                        
                        {{-- Headline --}}
                        @if($index === 0)
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[2.75rem] xl:text-[3.25rem] font-montserrat font-light tracking-tight text-[#0a1f12] dark:text-white leading-[1.15] mb-4">
                            @php
                                $headline = nl2br(e($slide->headline));
                                if (!str_contains($headline, '**') && str_contains($headline, 'HVM Digital')) {
                                    $headline = str_replace('HVM Digital', '**HVM Digital**', $headline);
                                }
                                $headline = preg_replace('/\*\*(.*?)\*\*/', '<span class="text-transparent bg-clip-text bg-gradient-to-r from-[#075749] to-[#9acb03] font-medium">$1</span>', $headline);
                            @endphp
                            {!! $headline !!}
                        </h1>
                        @else
                        <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-[2.75rem] xl:text-[3.25rem] font-montserrat font-light tracking-tight text-[#0a1f12] dark:text-white leading-[1.15] mb-4">
                            @php
                                $headline = nl2br(e($slide->headline));
                                if (!str_contains($headline, '**') && str_contains($headline, 'HVM Digital')) {
                                    $headline = str_replace('HVM Digital', '**HVM Digital**', $headline);
                                }
                                $headline = preg_replace('/\*\*(.*?)\*\*/', '<span class="text-transparent bg-clip-text bg-gradient-to-r from-[#075749] to-[#9acb03] font-medium">$1</span>', $headline);
                            @endphp
                            {!! $headline !!}
                        </h2>
                        @endif
                        
                        @if($slide->subheadline)
                        <p class="text-sm sm:text-base md:text-lg text-gray-600 dark:text-gray-400 mb-5 font-light leading-relaxed max-w-lg">
                            {{ $slide->subheadline }}
                        </p>
                        @endif
                        
                        {{-- Features (Checkmarks) --}}
                        @if(($slide->feature_1 ?? null) || ($slide->feature_2 ?? null) || ($slide->feature_3 ?? null))
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6 mb-5 text-sm text-gray-600 dark:text-gray-400 font-medium">
                            @foreach(['feature_1', 'feature_2', 'feature_3'] as $feature)
                                @if($slide->$feature ?? null)
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full bg-[#9acb03]/20 flex items-center justify-center text-[#9acb03] shrink-0">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span>{{ $slide->$feature }}</span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        {{-- Button & Rating Avatars Container --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mt-1">
                            @php
                                $btnLink = $slide->button_link ?: wa_link(setting('wa_message_default','Halo HVM Digital, saya ingin konsultasi gratis'));
                            @endphp
                            <a href="{{ $btnLink }}"
                               target="_blank" onclick="trackWaClick('hero')"
                               class="w-full sm:w-auto text-center inline-block bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-bold text-base px-6 py-3.5 rounded-full shadow-[0_10px_30px_rgba(154,203,3,0.3)] hover:shadow-[0_15px_40px_rgba(154,203,3,0.5)] hover:scale-105 transition-all duration-300 whitespace-nowrap">
                               {{ $slide->button_text ?: 'Konsultasi Gratis Sekarang' }}
                            </a>

                            {{-- Avatars & Stars --}}
                            @if(($slide->rating_text ?? null) || ($slide->avatar_1 ?? null) || ($slide->avatar_2 ?? null) || ($slide->avatar_3 ?? null))
                            <div class="flex flex-col gap-1.5 ml-0 sm:ml-4 border-l-0 sm:border-l-2 sm:border-gray-200 sm:dark:border-white/10 sm:pl-6">
                                <div class="flex -space-x-3">
                                    <img class="w-10 h-10 rounded-full border-2 border-white dark:border-[#0a1f12] object-cover bg-gray-200" src="{{ $slide->avatar_1 ? get_image_url($slide->avatar_1) : 'https://i.pravatar.cc/100?img=1' }}" alt="Client" width="40" height="40" loading="lazy">
                                    <img class="w-10 h-10 rounded-full border-2 border-white dark:border-[#0a1f12] object-cover bg-gray-200" src="{{ $slide->avatar_2 ? get_image_url($slide->avatar_2) : 'https://i.pravatar.cc/100?img=2' }}" alt="Client" width="40" height="40" loading="lazy">
                                    <img class="w-10 h-10 rounded-full border-2 border-white dark:border-[#0a1f12] object-cover bg-gray-200" src="{{ $slide->avatar_3 ? get_image_url($slide->avatar_3) : 'https://i.pravatar.cc/100?img=3' }}" alt="Client" width="40" height="40" loading="lazy">
                                </div>
                                <div class="text-xs font-medium text-gray-600 dark:text-gray-400">
                                    <div class="flex items-center gap-1 text-yellow-400 mb-0.5">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= ($slide->stars ?? 5))
                                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @else
                                                <svg class="w-3 h-3 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span>{!! str_replace(['900+', '100+'], ['<span class="text-[#075749] dark:text-[#9acb03] font-bold">100+</span>', '<span class="text-[#075749] dark:text-[#9acb03] font-bold">100+</span>'], e($slide->rating_text ?: '100+ bisnis bergabung')) !!}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Image Content (Right Side) --}}
                    <div class="w-full md:w-1/2 relative flex items-center justify-center md:justify-end mt-10 md:mt-0">
                        @php
                            $imgSrc = $slide->image ? get_image_url($slide->image) : 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
                        @endphp
                        {{-- No shadow mask here as requested ("biar ga kepotong shadow") --}}
                        <img src="{{ $imgSrc }}" 
                             alt="Tim HVM Digital — Agensi Digital Marketing Surabaya siap membantu bisnis Anda meroket" width="600" height="500" 
                             class="max-w-full max-h-[340px] md:max-h-[400px] lg:max-h-[420px] xl:max-h-[520px] object-contain object-center pointer-events-none"
                             loading="eager" 
                             fetchpriority="high" 
                             decoding="async">
                    </div>

                </div>
            @endforeach
        </div>
        {{-- Slider Navigation Dots --}}
        @if($hero_slides->count() > 1)
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 md:left-4 md:translate-x-0 flex space-x-3 z-20">
            @foreach($hero_slides as $index => $slide)
                <button @click="currentSlide = {{ $index }}" aria-label="Tampilkan Slide {{ $index + 1 }}"
                        class="h-3 rounded-full transition-all duration-300"
                        :class="currentSlide === {{ $index }} ? 'bg-[#9acb03] w-8' : 'bg-gray-300 dark:bg-gray-700 w-3 hover:bg-[#075749]'">
                </button>
            @endforeach
        </div>
        @endif

    </div>
</section>
