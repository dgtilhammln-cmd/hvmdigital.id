@extends('layouts.admin')
@section('title','Landing Pages')
@section('page-title','Landing Pages Kota')
@section('content')
<div class="mb-6"><h2 class="text-white font-semibold">Landing Pages — GEO SEO</h2><p class="text-white/30 text-xs font-light mt-1">Edit konten landing page per kota untuk optimasi SEO lokal</p></div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($cities as $key => $city)
    @php $lp = $landingPages[$key] ?? null; @endphp
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-white/10 transition-colors">
        <div class="flex items-start justify-between mb-3">
            <div>
                <h3 class="text-white font-medium text-sm">{{ $city['name'] }}</h3>
                <p class="text-white/30 text-xs font-light">{{ $city['province'] }}</p>
            </div>
            <div class="flex gap-2">
                @if(!empty($city['is_hq']))<span class="bg-[#9acb03]/10 text-[#9acb03] text-xs px-2 py-0.5 rounded-full">HQ</span>@endif
                @if(!empty($city['is_branch']))<span class="bg-orange/10 text-orange text-xs px-2 py-0.5 rounded-full">Branch</span>@endif
            </div>
        </div>
        <div class="flex items-center gap-2 mb-4">
            <span class="w-2 h-2 rounded-full {{ $lp?->is_active ? 'bg-green-400' : 'bg-gray-600' }}"></span>
            <span class="text-white/30 text-xs font-light">{{ $lp ? ($lp->is_active ? 'Aktif' : 'Nonaktif') : 'Belum dikonfigurasi' }}</span>
        </div>
        <a href="{{ route('admin.landing-pages.edit', $key) }}" class="block text-center bg-white/5 hover:bg-[#9acb03]/10 border border-white/10 hover:border-[#9acb03]/30 text-white/70 hover:text-[#9acb03] text-xs font-light px-4 py-2.5 rounded-xl transition-all"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit Konten</a>
        <a href="{{ url($city['slug']) }}" target="_blank" class="block text-center mt-2 text-white/20 hover:text-[#9acb03] text-xs font-light transition-colors"><svg class="w-3.5 h-3.5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg> Lihat Halaman &rarr;</a>
    </div>
    @endforeach
</div>
@endsection
