{{-- === STATS / ANGKA YANG BICARA === --}}
<section class="py-12 bg-white dark:bg-[#0a1510] border-b border-gray-100 dark:border-white/5 relative z-10 -mt-8 md:-mt-12">
    <div class="container mx-auto px-4 lg:px-8 relative">
        <div class="relative rounded-3xl shadow-[0_25px_60px_rgba(7,87,73,0.25)] dark:shadow-[0_25px_60px_rgba(0,0,0,0.5)] border border-white/15 p-8 md:p-14 overflow-hidden max-w-6xl mx-auto"
             style="background: linear-gradient(135deg, #053d33 0%, #075749 50%, #0a6d58 100%);">
            
            {{-- Decorative Glow & Grid Background --}}
            <div class="absolute top-0 right-0 w-80 h-80 bg-gradient-to-bl from-[#9acb03]/20 to-transparent rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-[#9acb03]/15 to-transparent rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 30px 30px;"></div>

            {{-- Elegant Glowing Growth Chart Graphic in Background --}}
            <div class="absolute inset-x-0 bottom-0 h-40 md:h-56 opacity-30 pointer-events-none overflow-hidden flex items-end">
                <svg class="w-full h-full text-[#9acb03]" preserveAspectRatio="none" viewBox="0 0 1000 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 200V160C150 150 300 180 450 120C600 60 750 110 1000 20V200H0Z" fill="url(#growth-gradient)"/>
                    <path d="M0 160C150 150 300 180 450 120C600 60 750 110 1000 20" stroke="#9acb03" stroke-width="4" stroke-linecap="round"/>
                    {{-- Graphic Nodes --}}
                    <circle cx="300" cy="180" r="5" fill="#ffffff" stroke="#9acb03" stroke-width="3"/>
                    <circle cx="450" cy="120" r="5" fill="#ffffff" stroke="#9acb03" stroke-width="3"/>
                    <circle cx="750" cy="110" r="5" fill="#ffffff" stroke="#9acb03" stroke-width="3"/>
                    <circle cx="1000" cy="20" r="7" fill="#9acb03" stroke="#ffffff" stroke-width="3"/>
                    <defs>
                        <linearGradient id="growth-gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#9acb03" stop-opacity="0.5"/>
                            <stop offset="100%" stop-color="#9acb03" stop-opacity="0.0"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <div class="text-center mb-12 relative z-10">
                <span class="inline-block text-xs font-bold tracking-widest uppercase text-[#9acb03] bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full mb-3 border border-white/10 shadow-sm">
                    Angka yang Bicara
                </span>
                <h2 class="text-2xl md:text-4xl font-extrabold text-white tracking-tight">Dampak Nyata untuk Klien Kami</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 text-center relative z-10" id="stats-counter-section">
                {{-- Item 1 --}}
                <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-sm hover:bg-white/10 transition-all duration-300">
                    <div class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#9acb03] to-[#b6f003] mb-2 flex items-center justify-center">
                        <span class="count-up" data-target="{{ setting('stat_businesses_count', 100) }}">0</span>+
                    </div>
                    <p class="text-xs md:text-sm text-white/90 font-medium uppercase tracking-wider">Bisnis Bergabung</p>
                </div>
                {{-- Item 2 --}}
                <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-sm hover:bg-white/10 transition-all duration-300 md:border-l md:border-white/15">
                    <div class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#9acb03] to-[#b6f003] mb-2 flex items-center justify-center">
                        <span class="count-up" data-target="{{ setting('stat_experience_years', 5) }}">0</span>+
                    </div>
                    <p class="text-xs md:text-sm text-white/90 font-medium uppercase tracking-wider">Tahun Pengalaman</p>
                </div>
                {{-- Item 3 --}}
                <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-sm hover:bg-white/10 transition-all duration-300 md:border-l md:border-white/15">
                    <div class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#9acb03] to-[#b6f003] mb-2 flex items-center justify-center">
                        <span class="count-up" data-target="{{ setting('stat_satisfaction_rate', 4.9) }}">0.0</span>/5
                    </div>
                    <p class="text-xs md:text-sm text-white/90 font-medium uppercase tracking-wider">Rating Kepuasan</p>
                </div>
                {{-- Item 4 --}}
                <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-sm hover:bg-white/10 transition-all duration-300 md:border-l md:border-white/15">
                    <div class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#9acb03] to-[#b6f003] mb-2 flex items-center justify-center">
                        <span class="count-up" data-target="{{ setting('stat_cities_count', 15) }}">0</span>+
                    </div>
                    <p class="text-xs md:text-sm text-white/90 font-medium uppercase tracking-wider">Kota Dilayani</p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('stats-counter-section');
    if(!section) return;
    
    let animated = false;
    const observer = new IntersectionObserver((entries) => {
        if(entries[0].isIntersecting && !animated) {
            animated = true;
            const counters = document.querySelectorAll('.count-up');
            counters.forEach(counter => {
                const target = parseFloat(counter.getAttribute('data-target'));
                const duration = 2000; // 2 seconds animation
                let start = null;
                const step = (timestamp) => {
                    if (!start) start = timestamp;
                    const progress = Math.min((timestamp - start) / duration, 1);
                    // easeOutExpo for premium feel
                    const easeOut = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    
                    if(target % 1 !== 0) {
                        counter.innerText = (easeOut * target).toFixed(1);
                    } else {
                        counter.innerText = Math.floor(easeOut * target);
                    }
                    
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        counter.innerText = target; // Ensure it ends exactly on target
                    }
                };
                window.requestAnimationFrame(step);
            });
        }
    }, { threshold: 0.3 }); // Trigger when 30% of the section is visible
    
    observer.observe(section);
});
</script>
@endpush
