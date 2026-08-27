@extends('admin.layouts.app')
@section('title', 'SEO Per Halaman')
@section('content')
<div class="p-6 lg:p-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white">SEO Per Halaman</h1>
        <p class="text-white/50 text-sm mt-1">Atur meta title, description, dan keywords untuk setiap halaman website.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-5 py-3 rounded-xl text-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.seo.update') }}" method="POST">
        @csrf @method('PUT')

        @php
        $pages = [
            'home'      => 'Beranda (Homepage)',
            'about'     => 'Tentang Kami',
            'services'  => 'Layanan',
            'portfolio' => 'Portfolio',
            'articles'  => 'Artikel / Blog',
            'contact'   => 'Kontak',
        ];
        @endphp

        <div class="space-y-6">
            @foreach($pages as $key => $label)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-[#9acb03]/20 transition-colors">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #075749, #9acb03);">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-semibold text-white">{{ $label }}</h3>
                    <span class="text-xs text-white/30 font-mono bg-white/5 px-2 py-0.5 rounded">{{ $key }}</span>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    {{-- Meta Title --}}
                    <div>
                        <label class="block text-white/60 text-xs font-medium mb-2">
                            Meta Title
                            <span class="text-white/30 ml-1">(max 60 karakter)</span>
                        </label>
                        <input type="text"
                               name="{{ $key }}_meta_title"
                               value="{{ setting($key.'_meta_title', '') }}"
                               maxlength="70"
                               placeholder="Contoh: Jasa Website Profesional {{ ucfirst($key) === 'Home' ? 'Surabaya' : '' }} | HVM Digital"
                               class="w-full bg-white/5 border border-white/10 focus:border-[#9acb03]/50 text-white placeholder-white/20 rounded-xl px-4 py-3 text-sm outline-none transition-colors"
                               x-data
                               x-on:input="$el.nextElementSibling.textContent = $el.value.length + '/70'">
                        <p class="text-white/30 text-xs mt-1 text-right">{{ strlen(setting($key.'_meta_title', '')) }}/70</p>
                    </div>

                    {{-- Meta Description --}}
                    <div>
                        <label class="block text-white/60 text-xs font-medium mb-2">
                            Meta Description
                            <span class="text-white/30 ml-1">(max 160 karakter)</span>
                        </label>
                        <textarea name="{{ $key }}_meta_description"
                                  rows="2"
                                  maxlength="170"
                                  placeholder="Deskripsi singkat halaman yang muncul di hasil pencarian Google..."
                                  class="w-full bg-white/5 border border-white/10 focus:border-[#9acb03]/50 text-white placeholder-white/20 rounded-xl px-4 py-3 text-sm outline-none transition-colors resize-none"
                                  x-data
                                  x-on:input="$el.nextElementSibling.textContent = $el.value.length + '/170'">{{ setting($key.'_meta_description', '') }}</textarea>
                        <p class="text-white/30 text-xs mt-1 text-right">{{ strlen(setting($key.'_meta_description', '')) }}/170</p>
                    </div>

                    {{-- Meta Keywords --}}
                    <div>
                        <label class="block text-white/60 text-xs font-medium mb-2">
                            Meta Keywords
                            <span class="text-white/30 ml-1">(pisahkan dengan koma)</span>
                        </label>
                        <input type="text"
                               name="{{ $key }}_meta_keywords"
                               value="{{ setting($key.'_meta_keywords', '') }}"
                               placeholder="jasa website, digital marketing, HVM Digital..."
                               class="w-full bg-white/5 border border-white/10 focus:border-[#9acb03]/50 text-white placeholder-white/20 rounded-xl px-4 py-3 text-sm outline-none transition-colors">
                    </div>
                </div>

                {{-- Google Preview --}}
                @if(setting($key.'_meta_title'))
                <div class="mt-5 p-4 bg-white/5 rounded-xl border border-white/5">
                    <p class="text-white/30 text-xs mb-2 uppercase tracking-wider font-medium">Preview Google</p>
                    <p class="text-blue-400 text-sm font-medium truncate">{{ setting($key.'_meta_title') }}</p>
                    <p class="text-green-400 text-xs mt-0.5">https://hvm-digital.id/{{ $key === 'home' ? '' : $key }}</p>
                    <p class="text-white/50 text-xs mt-1 line-clamp-2">{{ setting($key.'_meta_description') }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit"
                    class="flex items-center gap-2 font-semibold px-8 py-3 rounded-xl text-[#075749] hover:opacity-90 transition-opacity"
                    style="background: linear-gradient(135deg, #9acb03, #7aaa00);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Semua SEO Settings
            </button>
        </div>
    </form>
</div>
@endsection
