@extends('layouts.admin')
@section('title','Tambah Kategori')
@section('page-title','Tambah Kategori Artikel')
@section('content')

<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.article-categories.index') }}" class="text-white/40 hover:text-white/70 text-sm transition-colors">← Semua Kategori</a>
    </div>

    <form method="POST" action="{{ route('admin.article-categories.store') }}" class="space-y-5">
        @csrf

        @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
            <ul class="text-red-400 text-sm space-y-1">@foreach($errors->all() as $e)<li>• {{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-5">
            <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase">Informasi Kategori</h3>

            <div>
                <label class="block text-white/40 text-xs font-medium mb-2">Kategori Induk <span class="text-white/20">(kosongkan jika ini kategori utama)</span></label>
                <select name="parent_id" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                    <option value="">— Tanpa induk (Kategori Utama) —</option>
                    @foreach($parents as $p)
                    <option value="{{ $p->id }}" {{ old('parent_id', request('parent_id')) == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-white/40 text-xs font-medium mb-2">Nama Kategori *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                       placeholder="Contoh: Digital Marketing">
                <p class="text-white/20 text-[11px] mt-1 font-light">Slug akan digenerate otomatis</p>
            </div>

            <div>
                <label class="block text-white/40 text-xs font-medium mb-2">Deskripsi <span class="text-white/20">(opsional)</span></label>
                <textarea name="description" rows="2"
                          class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"
                          placeholder="Deskripsi singkat kategori ini...">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-white/40 text-xs font-medium mb-2">Warna Badge</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="color" value="{{ old('color', '#9acb03') }}"
                               class="w-10 h-10 rounded-lg border border-white/10 bg-transparent cursor-pointer">
                        <input type="text" id="color-text" value="{{ old('color', '#9acb03') }}"
                               class="flex-1 bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none"
                               readonly>
                    </div>
                </div>
                <div>
                    <label class="block text-white/40 text-xs font-medium mb-2">Urutan (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active', '1') ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-white/20 bg-white/5 text-[#9acb03]">
                <label for="is_active" class="text-white/60 text-sm font-light cursor-pointer">Aktif (tampil di publik)</label>
            </div>
        </div>

        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-4">
            <h3 class="text-[#9acb03] text-xs font-semibold tracking-widest uppercase"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg> SEO Settings</h3>
            <div>
                <label class="block text-white/40 text-xs mb-1.5">Meta Title <span class="text-white/20">(kosongkan = auto)</span></label>
                <input type="text" name="meta_title" value="{{ old('meta_title') }}" maxlength="255"
                       class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                       placeholder="Judul untuk Google...">
            </div>
            <div>
                <label class="block text-white/40 text-xs mb-1.5">Meta Description</label>
                <textarea name="meta_description" rows="2" maxlength="320"
                          class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"
                          placeholder="Deskripsi halaman kategori ini...">{{ old('meta_description') }}</textarea>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('admin.article-categories.index') }}"
               class="flex-1 text-center border border-white/10 text-white/50 font-light text-sm px-6 py-3 rounded-xl hover:border-white/20 transition-all">
                Batal
            </a>
            <button type="submit"
                    class="flex-1 text-[#053d33] font-semibold text-sm px-6 py-3 rounded-xl hover:scale-105 transition-all"
                    style="background: linear-gradient(135deg, #9acb03, #b8e832);">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg> Simpan Kategori
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.querySelector('[type="color"]').addEventListener('input', function() {
    document.getElementById('color-text').value = this.value;
    this.closest('.flex').querySelector('[name="color"]').value = this.value;
});
</script>
@endpush
@endsection
