@extends('layouts.admin')
@section('title', 'Page Management')
@section('page-title', 'Page Management')
@section('page-subtitle', 'Kelola SEO, FAQ, dan OpenGraph secara sentral untuk semua halaman website')

@section('content')
<div class="space-y-6" x-data="{ activeTab: 'core' }">
    <!-- Tabs Header -->
    <div class="flex border-b border-white/10 gap-6">
        <button @click="activeTab = 'core'" :class="activeTab === 'core' ? 'border-[#9acb03] text-[#9acb03] font-semibold' : 'border-transparent text-white/50 hover:text-white/80'" class="pb-3 border-b-2 text-sm transition-all focus:outline-none">
            Halaman Inti & Statis
        </button>
        <button @click="activeTab = 'services'" :class="activeTab === 'services' ? 'border-[#9acb03] text-[#9acb03] font-semibold' : 'border-transparent text-white/50 hover:text-white/80'" class="pb-3 border-b-2 text-sm transition-all focus:outline-none">
            Halaman Layanan Dinamis
        </button>
        <button @click="activeTab = 'cities'" :class="activeTab === 'cities' ? 'border-[#9acb03] text-[#9acb03] font-semibold' : 'border-transparent text-white/50 hover:text-white/80'" class="pb-3 border-b-2 text-sm transition-all focus:outline-none">
            Landing Pages Kota (GEO SEO)
        </button>
    </div>

    <!-- Core Pages Tab -->
    <div x-show="activeTab === 'core'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($corePages as $key => $page)
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-[#9acb03]/30 transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-white font-semibold text-sm">{{ $page['name'] }}</h3>
                            <span class="bg-[#9acb03]/10 text-[#9acb03] text-[10px] uppercase font-bold px-2 py-0.5 rounded-full">Core</span>
                        </div>
                        <p class="text-white/40 text-xs font-light mb-4">{{ $page['desc'] }}</p>
                    </div>
                    
                    <div class="space-y-2 mt-auto">
                        <a href="{{ route('admin.page-management.edit-core', $key) }}" class="block text-center bg-white/5 hover:bg-[#9acb03]/15 border border-white/10 hover:border-[#9acb03]/30 text-white/80 hover:text-[#9acb03] text-xs font-medium px-4 py-2.5 rounded-xl transition-all">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit SEO & FAQ
                        </a>
                        <a href="{{ $key === 'home' ? url('/') : ($key === 'services.seo' ? route('services.seo') : route(str_replace('.index', '', $key))) }}" target="_blank" class="block text-center text-white/30 hover:text-[#9acb03] text-xs font-light transition-colors">
                            Lihat Halaman &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Dynamic Services Tab -->
    <div x-show="activeTab === 'services'" class="space-y-4" x-cloak>
        <div class="mb-4">
            <h3 class="text-white font-semibold text-sm">Halaman Layanan Dinamis (Total: {{ count($services) }})</h3>
            <p class="text-white/40 text-xs font-light mt-1">Kelola konten, harga, SEO, FAQ kustom, dan OpenGraph per layanan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($services as $service)
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-[#9acb03]/30 transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-white font-semibold text-sm">{{ $service->name }}</h3>
                            <span class="bg-[#9acb03]/10 text-[#9acb03] text-[10px] uppercase font-bold px-2 py-0.5 rounded-full">Layanan</span>
                        </div>
                        <p class="text-white/40 text-xs font-light mb-4">{{ Str::limit(strip_tags($service->short_description), 100) }}</p>
                        
                        <div class="flex items-center gap-1.5 mb-4">
                            <span class="w-1.5 h-1.5 rounded-full {{ $service->is_active ? 'bg-green-400' : 'bg-white/20' }}"></span>
                            <span class="text-white/40 text-[11px] font-light">{{ $service->is_active ? 'Aktif' : 'Draft / Nonaktif' }}</span>
                        </div>
                    </div>

                    <div class="space-y-2 mt-auto">
                        <a href="{{ route('admin.services.edit', $service) }}" class="block text-center bg-white/5 hover:bg-[#9acb03]/15 border border-white/10 hover:border-[#9acb03]/30 text-white/80 hover:text-[#9acb03] text-xs font-medium px-4 py-2.5 rounded-xl transition-all">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Konten, SEO & FAQ
                        </a>
                        <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="block text-center text-white/30 hover:text-[#9acb03] text-xs font-light transition-colors">
                            Lihat Halaman &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- City Landing Pages Tab -->
    <div x-show="activeTab === 'cities'" class="space-y-4" x-cloak>
        <div class="mb-4">
            <h3 class="text-white font-semibold text-sm">Landing Pages per Kota (Total: {{ count($cities) }})</h3>
            <p class="text-white/40 text-xs font-light mt-1">Kelola SEO, FAQ kustom, dan OpenGraph Gambar per kota</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($cities as $key => $city)
                @php $lp = $landingPages[$key] ?? null; @endphp
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-[#9acb03]/30 transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-white font-semibold text-sm">{{ $city['name'] }}</h3>
                                <p class="text-white/30 text-xs font-light">{{ $city['province'] }}</p>
                            </div>
                            <div class="flex gap-1.5">
                                @if(!empty($city['is_hq']))
                                    <span class="bg-[#9acb03]/10 text-[#9acb03] text-[9px] font-bold px-1.5 py-0.5 rounded">HQ</span>
                                @endif
                                @if(!empty($city['is_branch']))
                                    <span class="bg-orange-500/10 text-orange-400 text-[9px] font-bold px-1.5 py-0.5 rounded">Branch</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-1.5 mb-4">
                            <span class="w-1.5 h-1.5 rounded-full {{ $lp?->is_active ? 'bg-green-400' : 'bg-white/20' }}"></span>
                            <span class="text-white/40 text-[11px] font-light">{{ $lp ? ($lp->is_active ? 'Aktif' : 'Nonaktif') : 'Menggunakan Bawaan' }}</span>
                        </div>
                    </div>

                    <div class="space-y-2 mt-auto">
                        <a href="{{ route('admin.landing-pages.edit', $key) }}" class="block text-center bg-white/5 hover:bg-[#9acb03]/15 border border-white/10 hover:border-[#9acb03]/30 text-white/80 hover:text-[#9acb03] text-xs font-medium px-4 py-2.5 rounded-xl transition-all">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Konten & SEO
                        </a>
                        <a href="{{ url($city['slug']) }}" target="_blank" class="block text-center text-white/30 hover:text-[#9acb03] text-xs font-light transition-colors">
                            Lihat Halaman &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
