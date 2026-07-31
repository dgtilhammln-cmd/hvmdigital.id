<footer class="bg-[#075749] dark:bg-[#061009] border-t border-white/10 dark:border-white/5 pt-16 pb-8">
    <div class="container mx-auto px-4 lg:px-8">
        {{-- Gradient accent line --}}
        <div class="h-px mb-14 rounded-full" style="background:linear-gradient(90deg,transparent 0%,rgba(154,203,3,0.3) 30%,rgba(154,203,3,0.7) 60%,rgba(154,203,3,0.3) 85%,transparent 100%);"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <div class="mb-5">
                    @php
                        $footerLogoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
                    @endphp
                    <img src="{{ $footerLogoUrl }}" alt="{{ setting('site_name', 'HVM Digital') }}" class="h-10 w-auto brightness-0 invert" loading="lazy"
                         onerror="this.outerHTML='<span class=\'font-bold text-white text-xl\'>{{ setting('site_name', 'HVM Digital') }}</span>'">
                </div>
                <p class="text-white/50 text-sm font-light leading-relaxed mb-6 max-w-xs">
                    Harbour Visionary Minds — mitra One-Stop Solution Digital Marketing & IT untuk bisnis Anda tumbuh dan ditemukan pelanggan.
                </p>
                <div class="flex gap-3">
                    <a href="{{ setting('instagram','#') }}" target="_blank" rel="noopener" aria-label="Instagram HVM Digital"
                       class="w-9 h-9 bg-white/10 hover:bg-[#9acb03] rounded-xl flex items-center justify-center text-white/50 hover:text-[#053d33] transition-all border border-white/10 hover:border-[#9acb03]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="{{ wa_link() }}" target="_blank" rel="noopener" onclick="trackWaClick('footer')" aria-label="WhatsApp HVM Digital"
                       class="w-9 h-9 bg-white/10 hover:bg-green-500 rounded-xl flex items-center justify-center text-white/50 hover:text-white transition-all border border-white/10 hover:border-green-500">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Layanan --}}
            <div>
                <h3 class="text-white font-semibold text-xs tracking-widest uppercase mb-5">Layanan</h3>
                <ul class="space-y-3">
                    @foreach(['Pembuatan Website','SEO & Optimasi','Google & Meta Ads','Social Media','Desain Grafis','Aplikasi Custom'] as $s)
                    <li><a href="{{ route('services') }}" class="text-white/50 hover:text-[#9acb03] text-sm font-light transition-colors">{{ $s }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Area Layanan --}}
            <div>
                <h3 class="text-white font-semibold text-xs tracking-widest uppercase mb-5">Area Layanan</h3>
                <ul class="space-y-3">
                    @php $footerCities = ['jakarta'=>'Jakarta','surabaya'=>'Surabaya','medan'=>'Medan','makassar'=>'Makassar']; @endphp
                    @foreach($footerCities as $key => $name)
                    @if(isset(config('cities')[$key]))
                    <li>
                        <a href="{{ url(config('cities')[$key]['slug']) }}" class="text-white/50 hover:text-[#9acb03] text-sm font-light transition-colors flex items-center gap-2">
                            <svg class="w-3 h-3 text-[#9acb03] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Website {{ $name }}
                        </a>
                    </li>
                    @endif
                    @endforeach
                    <li>
                        <a href="{{ route('services') }}" class="text-[#9acb03] text-xs font-medium hover:underline">Lihat semua kota &rarr;</a>
                    </li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h3 class="text-white font-semibold text-xs tracking-widest uppercase mb-5">Kontak</h3>
                <ul class="space-y-4">
                    <li class="flex gap-3 items-start">
                        <svg class="w-4 h-4 text-[#9acb03] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <div>
                            <p class="text-white/80 text-[11px] font-semibold mb-0.5">Surabaya <span class="text-[#9acb03] font-normal">(Pusat)</span></p>
                            <span class="text-white/40 text-xs font-light leading-relaxed block">{{ setting('address_surabaya','Jl. Rungkut Lor VII Dalam, Surabaya, Jawa Timur') }}</span>
                        </div>
                    </li>
                    <li class="flex gap-3 items-start">
                        <svg class="w-4 h-4 text-[#9acb03] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <div>
                            <p class="text-white/80 text-[11px] font-semibold mb-0.5">Bekasi <span class="text-white/30 font-normal">(Jabodetabek)</span></p>
                            <span class="text-white/40 text-xs font-light leading-relaxed block">{{ setting('address_bekasi','Kota Bekasi, Jawa Barat') }}</span>
                        </div>
                    </li>
                    <li class="flex gap-3 items-center">
                        <svg class="w-4 h-4 text-[#9acb03] shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        <a href="{{ wa_link() }}" target="_blank" class="text-white/50 hover:text-[#9acb03] text-sm font-light transition-colors">{{ setting('whatsapp_display','+62851-7998-2373') }}</a>
                    </li>
                    <li class="flex gap-3 items-center">
                        <svg class="w-4 h-4 text-[#9acb03] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ setting('email','bisnis@hvmdigital.id') }}" class="text-white/50 hover:text-[#9acb03] text-sm font-light transition-colors">{{ setting('email','bisnis@hvmdigital.id') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom divider --}}
        <div class="h-px mb-6 bg-white/10 rounded-full"></div>

        {{-- Bottom bar --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-white/30 text-xs font-light">
                &copy; {{ date('Y') }} <span class="text-white/50 font-medium">HVM Digital</span>. Hak Cipta Dilindungi.
                &nbsp;|&nbsp; <span class="text-[#9acb03]/70 font-medium">#MeroketWithHVM</span>
            </p>
            <div class="flex items-center gap-5">
                @foreach([['home','Beranda'],['services','Layanan'],['portfolio','Portfolio'],['contact','Kontak']] as [$r,$l])
                <a href="{{ route($r) }}" class="text-white/30 hover:text-[#9acb03] text-xs font-light transition-colors">{{ $l }}</a>
                @endforeach
            </div>
        </div>
    </div>
</footer>
