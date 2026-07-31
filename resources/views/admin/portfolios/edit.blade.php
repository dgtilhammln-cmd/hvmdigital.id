@extends('layouts.admin')
@section('title','Edit Portfolio')
@section('page-title','Edit Portfolio')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-white text-lg font-medium">Edit: {{ $portfolio->title }}</h2>
        <p class="text-white/40 text-sm font-light">Perbarui detail karya atau proyek.</p>
    </div>
    <a href="{{ route('admin.portfolios.index') }}" class="text-white/50 hover:text-white text-sm transition-colors">
        &larr; Kembali
    </a>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 lg:p-8">
    <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-5">
                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Judul Proyek <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" required class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Nama Klien</label>
                        <input type="text" name="client" value="{{ old('client', $portfolio->client) }}" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Kategori <span class="text-white/30">(contoh: Web Design, Branding)</span></label>
                        <input type="text" name="category" value="{{ old('category', $portfolio->category) }}" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Deskripsi Proyek</label>
                    <textarea name="description" rows="4" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">{{ old('description', $portfolio->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">URL / Link Proyek</label>
                        <input type="url" name="url" value="{{ old('url', $portfolio->url) }}" placeholder="https://" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Kota</label>
                        <input type="text" name="city" value="{{ old('city', $portfolio->city) }}" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-[#0a1f12] p-5 rounded-xl border border-white/5">
                    <label class="block text-white/70 text-xs font-medium mb-3">Featured Image <span class="text-white/30">(Maks 5MB)</span></label>
                    
                    <div x-data="{ preview: '{{ $portfolio->featured_image_thumb ? asset($portfolio->featured_image_thumb) : '' }}' }" class="space-y-4">
                        <div class="border-2 border-dashed border-white/10 rounded-xl p-4 text-center hover:border-[#9acb03]/50 transition-colors relative cursor-pointer"
                             @click="$refs.file.click()">
                            <template x-if="!preview">
                                <div class="py-4">
                                    <svg class="w-8 h-8 text-white/20 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-xs text-white/50 block">Klik untuk mengganti gambar</span>
                                </div>
                            </template>
                            <template x-if="preview">
                                <div>
                                    <img :src="preview" class="w-full max-h-40 object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                        <span class="text-white text-xs font-medium">Ubah Gambar</span>
                                    </div>
                                </div>
                            </template>
                            <input type="file" name="featured_image" x-ref="file" accept="image/*" class="hidden" 
                                   @change="const f = $event.target.files[0]; if(f) { const r = new FileReader(); r.onload = (e) => preview = e.target.result; r.readAsDataURL(f); }">
                        </div>
                    </div>
                </div>

                <div class="bg-[#0a1f12] p-5 rounded-xl border border-white/5 space-y-4">
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Nama File Gambar <span class="text-white/30">(SEO - Opsional)</span></label>
                        <input type="text" name="custom_filename" value="{{ old('custom_filename') }}" placeholder="contoh: portofolio-desain-hvm" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                        <span class="text-white/30 text-[10px]">Jika dikosongkan, nama file akan otomatis di-generate berdasarkan Judul Proyek.</span>
                    </div>

                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Urutan Tampil</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $portfolio->sort_order) }}" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                    </div>
                    
                    <div class="flex items-center gap-3 bg-[#0d1f15] p-3 rounded-lg border border-white/10">
                        <input type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $portfolio->is_active)) class="w-4 h-4 text-[#9acb03] bg-transparent border-white/20 rounded focus:ring-[#9acb03]">
                        <label for="is_active" class="text-white/80 text-sm cursor-pointer select-none">Publikasikan (Aktif)</label>
                    </div>
                </div>
                
                <button type="submit" class="w-full px-5 py-3 bg-[#9acb03] text-[#053d33] font-semibold text-sm rounded-xl hover:bg-[#b8e832] transition-colors shadow-lg">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
