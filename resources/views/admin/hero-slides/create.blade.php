@extends('layouts.admin')
@section('title', 'Tambah Slide')
@section('page-title', 'Tambah Slide Baru')
@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.hero-slides.index') }}" class="w-10 h-10 rounded-full bg-white/5 border border-white/5 flex items-center justify-center text-white/50 hover:bg-white/10 hover:text-white transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <div><h2 class="text-white font-semibold">Tambah Slide</h2></div>
    </div>

    <form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            <h3 class="text-[#9acb03] font-semibold text-sm uppercase tracking-widest border-b border-white/5 pb-4">Konten Teks</h3>
            
            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Headline <span class="text-red-400">*</span></label>
                <input type="text" name="headline" value="{{ old('headline') }}" required class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Contoh: Growth With HVM Digital">
                @error('headline')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Subheadline</label>
                <textarea name="subheadline" rows="3" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all resize-y" placeholder="Deskripsi singkat untuk slide ini...">{{ old('subheadline') }}</textarea>
                @error('subheadline')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Teks Tombol</label>
                    <input type="text" name="button_text" value="{{ old('button_text', 'Konsultasi Gratis Sekarang') }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Link Tombol (Opsional)</label>
                    <input type="text" name="button_link" value="{{ old('button_link') }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Kosongkan untuk mengarah ke WhatsApp default">
                </div>
            </div>
        </div>

        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 md:p-8 space-y-6">
            <h3 class="text-[#9acb03] font-semibold text-sm uppercase tracking-widest border-b border-white/5 pb-4">Media & Pengaturan Utama</h3>
            
            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Gambar Slide Utama (PNG/WebP disarankan) <span class="text-red-400">*</span></label>
                <input type="file" name="image" accept="image/*" required class="w-full bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-[#9acb03]/20 file:text-[#9acb03] hover:file:bg-[#9acb03]/30">
                <p class="text-white/30 text-xs mt-2">Gambar akan otomatis dikompresi ke format WebP.</p>
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
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Status Aktif</label>
                    <div class="flex items-center h-[46px]">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
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
                    <input type="text" name="rating_text" value="{{ old('rating_text', '100+ bisnis bergabung') }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Contoh: 100+ bisnis bergabung">
                </div>
                <div>
                    <label class="block text-white/60 text-xs font-medium mb-2.5">Jumlah Bintang Rating (1-5)</label>
                    <input type="number" name="stars" min="1" max="5" value="{{ old('stars', 5) }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all">
                </div>
            </div>

            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Fitur Centang (Kosongkan jika tidak perlu)</label>
                <div class="space-y-3">
                    <input type="text" name="feature_1" value="{{ old('feature_1', 'Konsultasi Gratis') }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Fitur 1">
                    <input type="text" name="feature_2" value="{{ old('feature_2', 'Dipercaya 100+ Perusahaan') }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Fitur 2">
                    <input type="text" name="feature_3" value="{{ old('feature_3', 'Garansi Kepuasan') }}" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 focus:bg-[#0a1f12] transition-all" placeholder="Fitur 3">
                </div>
            </div>

            <div>
                <label class="block text-white/60 text-xs font-medium mb-2.5">Foto Avatar Klien (Kosongkan akan pakai foto acak/default)</label>
                <div class="space-y-3">
                    <input type="file" name="avatar_1" accept="image/*" class="w-full bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-2 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white hover:file:bg-white/20">
                    <input type="file" name="avatar_2" accept="image/*" class="w-full bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-2 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white hover:file:bg-white/20">
                    <input type="file" name="avatar_3" accept="image/*" class="w-full bg-white/5 border border-white/10 text-white/50 font-light text-xs px-4 py-2 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-white/10 file:text-white hover:file:bg-white/20">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.01] transition-all">Simpan Slide Baru</button>
    </form>
</div>
@endsection
