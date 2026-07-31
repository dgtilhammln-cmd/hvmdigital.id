@extends('layouts.admin')
@section('title','Edit Paket Harga')
@section('page-title','Edit Paket')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-white text-lg font-medium">Edit: {{ $pricingPackage->name }}</h2>
        <p class="text-white/40 text-sm font-light">Perbarui detail paket harga ini.</p>
    </div>
    <a href="{{ route('admin.pricing_packages.index') }}" class="text-white/50 hover:text-white text-sm transition-colors">
        &larr; Kembali
    </a>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 lg:p-8">
    @php
        // Prepare existing features for AlpineJS
        $feats = is_array($pricingPackage->features) && count($pricingPackage->features) > 0 
                    ? $pricingPackage->features 
                    : [''];
    @endphp
    <form action="{{ route('admin.pricing_packages.update', $pricingPackage) }}" method="POST" x-data="{ features: {{ Js::from($feats) }} }">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Kiri --}}
            <div class="space-y-5">
                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Nama Paket <span class="text-red-400">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $pricingPackage->name) }}" required class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                </div>
                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Harga <span class="text-red-400">*</span></label>
                    <input type="text" name="price" value="{{ old('price', $pricingPackage->price) }}" required class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                </div>
                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">{{ old('description', $pricingPackage->description) }}</textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Tema Visual <span class="text-red-400">*</span></label>
                        <select name="theme_style" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                            <option value="starter" @selected(old('theme_style', $pricingPackage->theme_style) == 'starter')>Starter (Putih)</option>
                            <option value="professional" @selected(old('theme_style', $pricingPackage->theme_style) == 'professional')>Professional (Highlight Hijau)</option>
                            <option value="enterprise" @selected(old('theme_style', $pricingPackage->theme_style) == 'enterprise')>Enterprise (Putih)</option>
                            <option value="custom" @selected(old('theme_style', $pricingPackage->theme_style) == 'custom')>Custom (Gradien Gelap)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Urutan Tampil <span class="text-red-400">*</span></label>
                        <input type="number" name="order" value="{{ old('order', $pricingPackage->order) }}" required class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                    </div>
                </div>

                <div class="flex items-center gap-3 bg-[#0a1f12] border border-white/5 rounded-xl p-4">
                    <input type="checkbox" name="is_popular" id="is_popular" value="1" @checked(old('is_popular', $pricingPackage->is_popular)) class="w-4 h-4 text-[#9acb03] bg-transparent border-white/20 rounded focus:ring-[#9acb03]">
                    <label for="is_popular" class="text-white/80 text-sm cursor-pointer select-none">Tandai sebagai "Paling Populer"</label>
                </div>
            </div>

            {{-- Kanan --}}
            <div class="space-y-5">
                <div class="bg-[#0a1f12] border border-white/5 p-5 rounded-xl">
                    <label class="block text-[#9acb03] text-sm font-medium mb-4">Daftar Fitur (List)</label>
                    
                    <div class="space-y-3" id="features-container">
                        <template x-for="(feat, index) in features" :key="index">
                            <div class="flex gap-2">
                                <input type="text" :name="'features['+index+']'" x-model="features[index]" class="flex-1 bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                                <button type="button" @click="features.splice(index, 1)" class="w-10 flex items-center justify-center text-red-400/50 hover:text-red-400 bg-red-400/5 hover:bg-red-400/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="features.push('')" class="mt-4 text-xs text-[#9acb03] hover:text-white flex items-center gap-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Fitur
                    </button>
                </div>

                <div class="bg-[#0a1f12] border border-white/5 p-5 rounded-xl">
                    <label class="block text-white/80 text-sm font-medium mb-4">Tombol CTA</label>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-white/50 text-xs mb-1.5">Teks Tombol <span class="text-red-400">*</span></label>
                            <input type="text" name="button_text" value="{{ old('button_text', $pricingPackage->button_text) }}" required class="w-full bg-[#0d1f15] border border-white/10 rounded-xl px-4 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-white/50 text-xs mb-1.5">Pesan Auto-fill WhatsApp</label>
                            <textarea name="wa_message" rows="2" class="w-full bg-[#0d1f15] border border-white/10 rounded-xl px-4 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">{{ old('wa_message', $pricingPackage->wa_message) }}</textarea>
                            <p class="text-[10px] text-white/30 mt-1">Pesan akan dikirim ke nomor agen yang aktif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-white/5 pt-6 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-[#9acb03] text-[#053d33] font-semibold text-sm rounded-xl hover:bg-[#b8e832] transition-colors shadow-lg">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
