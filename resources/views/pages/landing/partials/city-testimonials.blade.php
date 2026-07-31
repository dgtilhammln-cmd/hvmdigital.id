@if($testimonials->count())
<section class="py-20 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-6">
            <div class="text-center md:text-left">
                <h2 class="text-3xl font-bold text-[#0a1f12] dark:text-white mb-3">Testimoni Klien</h2>
            </div>
        </div>
        
        {{-- Unified Swipeable Slider (1 Row for Desktop & Mobile) --}}
        <div class="relative w-full overflow-hidden">
            <div class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-6 scroll-smooth cursor-grab active:cursor-grabbing" style="scrollbar-width: none;">
                @foreach($testimonials as $t)
                <div class="shrink-0 w-[85vw] md:w-[calc(33.333%-1rem)] lg:w-[calc(33.333%-1rem)] snap-center bg-white dark:bg-[#0d1f15] rounded-2xl p-7 border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/30 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-4">
                        @for($star = 1; $star <= 5; $star++)
                        <svg class="w-4 h-4 {{ $star <= $t->rating ? 'text-yellow-400' : 'text-gray-200 dark:text-gray-700' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 font-light text-sm leading-relaxed mb-6">"{{ $t->content }}"</p>
                    <div class="flex items-center gap-3 border-t border-[#075749]/10 dark:border-[#9acb03]/10 pt-5">
                        @if($t->photo)
                            <img src="{{ get_image_url($t->photo) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover shrink-0 border-2 border-[#9acb03]/30">
                        @else
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0" style="background: linear-gradient(135deg, #075749, #9acb03);">
                                {{ strtoupper(substr($t->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-semibold text-[#0a1f12] dark:text-white text-sm">{{ $t->name }}</div>
                            <div class="text-gray-400 text-xs font-light">{{ $t->company }} @if($t->city) &middot; {{ $t->city }} @endif</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
