@extends('layouts.admin')
@section('title','Edit Karir')
@section('page-title','Edit Karir: ' . $career->title)
@section('content')
<div class="max-w-4xl">
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 md:p-8">
        <form action="{{ route('admin.careers.update', $career) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Posisi Karir</label>
                    <input type="text" name="title" value="{{ old('title', $career->title) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all placeholder:text-white/20">
                    @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Nama Divisi</label>
                    <input type="text" name="division" value="{{ old('division', $career->division) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all">
                    @error('division') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $career->location) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all">
                    @error('location') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Durasi Karir</label>
                    <input type="text" name="duration" value="{{ old('duration', $career->duration) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all">
                    @error('duration') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Custom Button Link (Opsional)</label>
                <input type="text" name="custom_link" value="{{ old('custom_link', $career->custom_link) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all placeholder:text-white/20" placeholder="Misal: mailto:hr@domain.com atau https://forms.gle/xyz">
                <p class="text-white/40 text-xs mt-1 font-light">Jika dikosongkan, tombol Apply akan otomatis mengarah ke WhatsApp Admin.</p>
                @error('custom_link') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Kualifikasi</label>
                <textarea name="qualifications" class="tinymce w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all" rows="5">{{ old('qualifications', $career->qualifications) }}</textarea>
                @error('qualifications') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Jobdesk</label>
                <textarea name="jobdesc" class="tinymce w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all" rows="5">{{ old('jobdesc', $career->jobdesc) }}</textarea>
                @error('jobdesc') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Status</label>
                    <select name="is_active" class="w-full bg-[#0a1510] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all">
                        <option value="1" {{ $career->is_active ? 'selected' : '' }}>Aktif (Dibuka)</option>
                        <option value="0" {{ !$career->is_active ? 'selected' : '' }}>Nonaktif (Ditutup)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">Urutan (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $career->sort_order) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all">
                </div>
            </div>

            <h3 class="text-white font-semibold text-lg border-b border-white/10 pb-2 mb-6">SEO (Opsional)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $career->seo_title) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-white/60 text-xs font-medium uppercase tracking-wider mb-2">SEO Description</label>
                    <textarea name="seo_description" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] outline-none transition-all" rows="3">{{ old('seo_description', $career->seo_description) }}</textarea>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold text-sm px-6 py-3 rounded-xl hover:scale-105 transition-all">Update Karir</button>
                <a href="{{ route('admin.careers.index') }}" class="text-white/50 hover:text-white text-sm font-medium transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('qualifications', {
        toolbar: [
            ['Undo', 'Redo'],
            ['Bold', 'Italic'],
            ['NumberedList', 'BulletedList'],
            ['Link', 'Unlink']
        ]
    });
    CKEDITOR.replace('jobdesc', {
        toolbar: [
            ['Undo', 'Redo'],
            ['Bold', 'Italic'],
            ['NumberedList', 'BulletedList'],
            ['Link', 'Unlink']
        ]
    });
</script>
@endpush
