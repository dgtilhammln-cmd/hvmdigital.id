@extends('layouts.admin')
@section('title','Pengaturan')
@section('page-title','Pengaturan Situs')
@section('content')

@if(session('success'))
<div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl px-5 py-3 mb-5 text-sm font-light flex items-center gap-2">
    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
@endif

<form id="settingsForm" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" novalidate>
    @csrf @method('POST')

    <div class="flex flex-col lg:flex-row gap-6 items-start">
        
        {{-- Sidebar Menu Tabs --}}
        <div class="w-full lg:w-64 shrink-0 self-start sticky top-[68px]">
            <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-4">
            <h2 class="text-white/40 text-xs font-medium uppercase tracking-widest mb-4 px-2">Menu Pengaturan</h2>
            <nav class="space-y-1">
                @foreach($settings as $group => $items)
                <button type="button" onclick="openSettingTab('{{ $group }}')" id="btn-tab-{{ $group }}"
                        class="settings-tab-btn w-full flex items-center gap-3 px-4 py-2.5 rounded-xl border text-sm font-light transition-all text-left {{ $loop->first ? 'bg-[#9acb03]/10 text-[#9acb03] border-[#9acb03]' : 'text-white/50 hover:bg-white/5 hover:text-white border-transparent' }}">
                    @switch($group)
                        @case('general') <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg> @break
                        @case('contact') <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg> @break
                        @case('seo')     <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg> @break
                        @case('social')  <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg> @break
                        @case('appearance') <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg> @break
                        @case('photos')  <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> @break
                        @case('clients') <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> @break
                        @case('mentions')<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg> @break
                        @case('feeds')   <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> @break
                        @case('analytics')<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg> @break
                        @case('agents')  <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg> @break
                        @case('seo')     <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg> @break
                        @case('payment') <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg> @break
                        @default         <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    @endswitch
                    {{ ucfirst($group) }}
                </button>
                @endforeach
            </nav>
            </div>{{-- end inner card --}}
        </div>{{-- end sticky sidebar --}}

        {{-- Content Area --}}
        <div class="flex-1 min-w-0 pb-20">
            @foreach($settings as $group => $items)
            <div id="tab-content-{{ $group }}" class="settings-tab-content {{ $loop->first ? '' : 'hidden' }}">
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-8 mb-6 relative overflow-hidden">
                    {{-- Decorative blur --}}
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#9acb03]/5 rounded-full blur-3xl pointer-events-none"></div>

                    <h3 class="text-white font-medium text-lg capitalize mb-2 relative z-10">Pengaturan {{ ucfirst($group) }}</h3>
                    <div class="mb-8 relative z-10">
                        @if($group === 'clients')
                            <p class="text-white/40 text-sm font-light">Upload logo klien (tampil sebagai ticker berjalan, disarankan logo transparan satu warna atau PNG HD).</p>
                        @elseif($group === 'mentions')
                            <p class="text-white/40 text-sm font-light">Logo media yang meliput HVM Digital. Gunakan logo yang jelas dan sertakan link asli artikel liputan.</p>
                        @elseif($group === 'photos')
                            <p class="text-white/40 text-sm font-light">Foto-foto yang digunakan pada layout halaman, seperti section Tentang Kami dan Banner CTA.</p>
                        @elseif($group === 'feeds')
                            <p class="text-white/40 text-sm font-light">Kelola 4 desain feeds Instagram HVM Digital (Rasio 4:5, 3375x4219). Tampil di halaman utama untuk meningkatkan interaksi sosial media dan SEO.</p>
                        @elseif($group === 'payment')
                            <p class="text-white/40 text-sm font-light">Konfigurasi API Key Midtrans untuk menerima pembayaran otomatis dari Tenant.</p>
                        @else
                            <p class="text-white/40 text-sm font-light">Kelola konfigurasi {{ $group }} untuk seluruh situs.</p>
                        @endif
                    </div>

                    @if($group === 'clients')
                    {{-- Special layout for clients: pair logo + alt per row --}}
                    <div class="space-y-6 relative z-10">
                        @php
                            $clientItems = $items->keyBy('key');
                            $slots = range(1, 8);
                        @endphp
                        @foreach($slots as $i)
                        @php
                            $logoKey = "client_{$i}_logo";
                            $altKey  = "client_{$i}_alt";
                            $logoSetting = $clientItems->get($logoKey);
                            $altSetting  = $clientItems->get($altKey);
                        @endphp
                        @if($logoSetting || $altSetting)
                        <div class="bg-white/5 rounded-xl p-5 border border-white/5">
                            <p class="text-[#9acb03] text-[10px] uppercase tracking-widest mb-4 font-semibold">Slot Klien {{ $i }}</p>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Logo (PNG/WebP transparan)</label>
                                    @if($logoSetting?->value)
                                        <div class="mb-3 p-3 bg-white/5 border border-white/5 rounded-lg inline-flex items-center gap-3">
                                            <img src="{{ get_image_url($logoSetting->value) }}" alt="Logo klien {{ $i }}" class="h-10 w-auto max-w-[150px] object-contain">
                                            <span class="text-green-400 text-[10px] flex items-center gap-1"><svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Uploaded</span>
                                        </div><br>
                                    @endif
                                    <input type="file" name="{{ $logoKey }}" accept="image/*"
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white/50 font-light text-xs px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white/60 hover:file:bg-white/20">
                                </div>
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Alt Text — SEO Friendly</label>
                                    <input type="text" name="{{ $altKey }}" value="{{ $altSetting?->value }}" placeholder="Contoh: PT Mitra Jaya — Klien Website HVM Digital Surabaya"
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                                    <p class="text-white/20 text-[10px] mt-2 font-light leading-relaxed">Penting untuk SEO: Masukkan nama bisnis + layanan yang dikerjakan.</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    @elseif($group === 'mentions')
                    {{-- Special layout for mentions: logo + alt + link per row --}}
                    <div class="space-y-6 relative z-10">
                        @php
                            $mentionItems = $items->keyBy('key');
                            $mSlots = range(1, 5);
                        @endphp
                        @foreach($mSlots as $i)
                        @php
                            $logoKey = "mention_{$i}_logo";
                            $altKey  = "mention_{$i}_alt";
                            $linkKey = "mention_{$i}_link";
                            $logoSetting = $mentionItems->get($logoKey);
                            $altSetting  = $mentionItems->get($altKey);
                            $linkSetting = $mentionItems->get($linkKey);
                        @endphp
                        @if($logoSetting || $altSetting)
                        <div class="bg-white/5 rounded-xl p-5 border border-white/5">
                            <p class="text-[#9acb03] text-[10px] uppercase tracking-widest mb-4 font-semibold">Slot Media {{ $i }}</p>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Logo Media</label>
                                    @if($logoSetting?->value)
                                        <div class="mb-3 p-3 bg-white/5 border border-white/5 rounded-lg inline-flex items-center gap-3">
                                            <img src="{{ get_image_url($logoSetting->value) }}" alt="Logo media {{ $i }}" class="h-10 w-auto max-w-[120px] object-contain">
                                        </div><br>
                                    @endif
                                    <input type="file" name="{{ $logoKey }}" accept="image/*"
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white/50 font-light text-xs px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white/60 hover:file:bg-white/20">
                                </div>
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Alt Text (SEO)</label>
                                    <input type="text" name="{{ $altKey }}" value="{{ $altSetting?->value }}" placeholder="Contoh: RRI meliput HVM Digital Surabaya"
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                                </div>
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Link Berita Asli</label>
                                    <input type="url" name="{{ $linkKey }}" value="{{ $linkSetting?->value }}" placeholder="https://rri.co.id/..."
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    @elseif($group === 'feeds')
                    {{-- Special layout for Instagram Feeds: image + alt + link per row --}}
                    <div class="space-y-6 relative z-10">
                        @php
                            $feedItems = $items->keyBy('key');
                            $fSlots = range(1, 4);
                        @endphp
                        @foreach($fSlots as $i)
                        @php
                            $imgKey  = "feed_{$i}_image";
                            $altKey  = "feed_{$i}_alt";
                            $linkKey = "feed_{$i}_link";
                            $imgSetting  = $feedItems->get($imgKey);
                            $altSetting  = $feedItems->get($altKey);
                            $linkSetting = $feedItems->get($linkKey);
                        @endphp
                        <div class="bg-white/5 rounded-xl p-5 border border-white/5">
                            <p class="text-[#9acb03] text-[10px] uppercase tracking-widest mb-4 font-semibold">Slot Feed Instagram {{ $i }} (3375 x 4219)</p>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Gambar Feed (Rasio 4:5)</label>
                                    @if($imgSetting?->value)
                                        <div class="mb-3 p-3 bg-white/5 border border-white/5 rounded-lg inline-flex items-center gap-3">
                                            <img src="{{ get_image_url($imgSetting->value) }}" alt="Feed {{ $i }}" class="h-20 w-auto object-contain rounded">
                                        </div><br>
                                    @endif
                                    <input type="file" name="{{ $imgKey }}" accept="image/*"
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white/50 font-light text-xs px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white/60 hover:file:bg-white/20">
                                </div>
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Alt Text (SEO)</label>
                                    <input type="text" name="{{ $altKey }}" value="{{ $altSetting?->value }}" placeholder="Contoh: Desain Feed Instagram Promosi HVM Digital"
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                                </div>
                                <div>
                                    <label class="block text-white/40 text-xs font-medium mb-2.5">Link Postingan IG</label>
                                    <input type="url" name="{{ $linkKey }}" value="{{ $linkSetting?->value }}" placeholder="https://www.instagram.com/p/..."
                                           class="w-full bg-[#0a1f12] border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @else
                    {{-- Default layout for other groups --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                        @foreach($items as $setting)
                        <div class="{{ $setting->type === 'textarea' ? 'md:col-span-2' : '' }}">
                            <label class="block text-white/60 text-xs font-medium mb-2.5">{{ $setting->label ?? $setting->key }}</label>
                            @if($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" rows="4"
                                          class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all resize-y">{{ $setting->value }}</textarea>
                            @elseif($setting->type === 'image')
                                @if($setting->value)
                                    <div class="mb-3 p-3 bg-white/5 border border-white/5 rounded-xl inline-block">
                                        <img src="{{ get_image_url($setting->value) }}" alt="{{ $setting->label }}" class="h-24 w-auto object-contain rounded-lg">
                                    </div><br>
                                @endif
                                <input type="file" name="{{ $setting->key }}" accept="image/*"
                                       class="w-full bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-[#9acb03]/20 file:text-[#9acb03] hover:file:bg-[#9acb03]/30">
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                       class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    {{-- Floating Action Button (Save) --}}
    <div class="fixed bottom-8 right-8 z-[9999]">
        <button type="submit" class="bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold px-8 py-3.5 rounded-2xl shadow-[0_0_20px_rgba(154,203,3,0.4)] hover:shadow-[0_0_30px_rgba(154,203,3,0.6)] hover:scale-105 transition-all flex items-center gap-2 cursor-pointer pointer-events-auto">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg> Simpan Perubahan
        </button>
    </div>
</form>

@push('scripts')
<script>
    function openSettingTab(tabName) {
        document.querySelectorAll('.settings-tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.settings-tab-btn').forEach(el => {
            el.classList.remove('bg-[#9acb03]/10', 'text-[#9acb03]', 'border-[#9acb03]');
            el.classList.add('text-white/50', 'border-transparent');
        });
        
        const content = document.getElementById('tab-content-' + tabName);
        if(content) content.classList.remove('hidden');
        
        const btn = document.getElementById('btn-tab-' + tabName);
        if(btn) {
            btn.classList.remove('text-white/50', 'border-transparent');
            btn.classList.add('bg-[#9acb03]/10', 'text-[#9acb03]', 'border-[#9acb03]');
        }
    }
</script>
@endpush
@endsection
