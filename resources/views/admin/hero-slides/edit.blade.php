@extends('layouts.admin')
@section('title', 'Edit Slide')
@section('page-title', 'Edit Slide')
@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.hero-slides.index') }}" class="w-10 h-10 rounded-full bg-white/5 border border-white/5 flex items-center justify-center text-white/50 hover:bg-white/10 hover:text-white transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <div><h2 class="text-white font-semibold">Edit Slide</h2></div>
    </div>

    <form action="{{ route('admin.hero-slides.update', $hero_slide) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        
        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            <h3 class="text-[#9acb03] font-semibold text-sm uppercase tracking-widest border-b border-white/5 pb-4">Konten Teks</h3>
            
            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Headline <span class="text-red-400">*</span></label>
                <input type="text" name="headline" value="{{ old('headline', $hero_slide->headline) }}" required class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                @error('headline')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Subheadline</label>
                <textarea name="subheadline" rows="3" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all resize-y">{{ old('subheadline', $hero_slide->subheadline) }}</textarea>
                @error('subheadline')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Teks Tombol</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $hero_slide->button_text) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Link Tombol (Opsional)</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $hero_slide->button_link) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
            </div>
        </div>

        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            <h3 class="text-[#9acb03] font-semibold text-sm uppercase tracking-widest border-b border-white/5 pb-4">Media & Pengaturan Utama</h3>
            
            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Gambar Slide Utama (Biarkan kosong jika tidak ingin mengubah)</label>
                @if($hero_slide->image)
                    <div class="mb-4">
                        <img src="{{ get_image_url($hero_slide->image) }}" class="h-24 w-auto object-cover rounded-lg bg-white/5 border border-white/10">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-[#9acb03]/20 file:text-[#9acb03] hover:file:bg-[#9acb03]/30">
                @error('image')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-white/60 text-xs font-medium mb-2">Nama File Gambar Slide <span class="text-white/30">(SEO - Opsional)</span></label>
                <input type="text" name="custom_filename" value="{{ old('custom_filename') }}" placeholder="contoh: slide-hvm-digital-utama" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                <span class="text-white/20 text-[10px] mt-1 block">Jika kosong, nama file akan otomatis mengikuti Headline. Avatar klien tambahan akan di-prefix secara otomatis.</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Urutan Tampil (Order)</label>
                    <input type="number" name="order" value="{{ old('order', $hero_slide->order) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Status Aktif</label>
                    <div class="flex items-center h-[46px]">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $hero_slide->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#9acb03]"></div>
                            <span class="ml-3 text-sm font-medium text-white/70">Tampilkan di Beranda</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            <h3 class="text-[#9acb03] font-semibold text-sm uppercase tracking-widest border-b border-white/5 pb-4">Elemen Tambahan (Opsional)</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Rating Teks</label>
                    <input type="text" name="rating_text" value="{{ old('rating_text', $hero_slide->rating_text) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Jumlah Bintang Rating (1-5)</label>
                    <input type="number" name="stars" min="1" max="5" value="{{ old('stars', $hero_slide->stars) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
            </div>

            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Fitur Centang (Kosongkan jika tidak perlu)</label>
                <div class="space-y-3">
                    <input type="text" name="feature_1" value="{{ old('feature_1', $hero_slide->feature_1) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Fitur 1">
                    <input type="text" name="feature_2" value="{{ old('feature_2', $hero_slide->feature_2) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Fitur 2">
                    <input type="text" name="feature_3" value="{{ old('feature_3', $hero_slide->feature_3) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Fitur 3">
                </div>
            </div>

            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Foto Avatar Klien (Biarkan kosong jika tidak diubah)</label>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        @if($hero_slide->avatar_1)<img src="{{ get_image_url($hero_slide->avatar_1) }}" class="w-8 h-8 rounded-full object-cover">@endif
                        <input type="file" name="avatar_1" accept="image/*" class="flex-1 bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-2 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white hover:file:bg-white/20">
                    </div>
                    <div class="flex items-center gap-3">
                        @if($hero_slide->avatar_2)<img src="{{ get_image_url($hero_slide->avatar_2) }}" class="w-8 h-8 rounded-full object-cover">@endif
                        <input type="file" name="avatar_2" accept="image/*" class="flex-1 bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-2 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white hover:file:bg-white/20">
                    </div>
                    <div class="flex items-center gap-3">
                        @if($hero_slide->avatar_3)<img src="{{ get_image_url($hero_slide->avatar_3) }}" class="w-8 h-8 rounded-full object-cover">@endif
                        <input type="file" name="avatar_3" accept="image/*" class="flex-1 bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-2 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white hover:file:bg-white/20">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.01] transition-all">Simpan Perubahan</button>
    </form>
</div>
@endsection
