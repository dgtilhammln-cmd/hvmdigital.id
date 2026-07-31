@extends('layouts.admin')
@section('title','Edit Layanan')
@section('page-title','Edit Layanan')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-white text-lg font-medium">Edit: {{ $service->name }}</h2>
        <p class="text-white/40 text-sm font-light">Perbarui detail produk/layanan digital Anda.</p>
    </div>
    <a href="{{ route('admin.services.index') }}" class="text-white/50 hover:text-white text-sm transition-colors">
        &larr; Kembali
    </a>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 lg:p-8">
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-5">
                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Nama Layanan *</label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}" required class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Icon SVG/Class (Opsional)</label>
                        <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Harga Mulai Dari (Opsional)</label>
                        <input type="number" name="price_start" value="{{ old('price_start', $service->price_start) }}" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Ringkasan Deskripsi (Maks 300 Karakter)</label>
                    <textarea name="short_description" rows="2" maxlength="300" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">{{ old('short_description', $service->short_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-white/70 text-xs font-medium mb-2">Deskripsi Lengkap</label>
                    <textarea name="description" rows="6" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:border-[#9acb03] focus:ring-1 focus:ring-[#9acb03] transition-all outline-none">{{ old('description', $service->description) }}</textarea>
                </div>

                {{-- FAQs Section --}}
                <div class="bg-[#0a1f12] p-5 rounded-xl border border-white/5 space-y-4" x-data="{ 
                    faqs: {{ json_encode($faqs) }},
                    addFaq() {
                        this.faqs.push({ id: null, question: '', answer: '', sort_order: this.faqs.length, is_active: 1 });
                    },
                    removeFaq(index) {
                        this.faqs.splice(index, 1);
                    }
                }">
                    <div class="flex items-center justify-between">
                        <h3 class="text-[#9acb03] text-xs font-semibold uppercase tracking-wider">FAQ Layanan</h3>
                        <button type="button" @click="addFaq()" class="bg-[#9acb03]/10 hover:bg-[#9acb03]/20 border border-[#9acb03]/30 text-[#9acb03] text-xs px-3 py-1.5 rounded-lg transition-all">+ Tambah FAQ</button>
                    </div>
                    
                    <div class="space-y-4">
                        <template x-for="(faq, index) in faqs" :key="index">
                            <div class="bg-black/20 border border-white/5 rounded-xl p-4 space-y-3 relative">
                                <button type="button" @click="removeFaq(index)" class="absolute top-3 right-3 text-red-400 hover:text-red-500 text-xs" title="Hapus FAQ">
                                    Hapus
                                </button>
                                
                                <input type="hidden" :name="'faqs['+index+'][id]'" :value="faq.id">
                                
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                    <div class="md:col-span-3">
                                        <label class="block text-white/30 text-[10px] uppercase mb-1">Pertanyaan</label>
                                        <input type="text" :name="'faqs['+index+'][question]'" x-model="faq.question" required class="w-full bg-[#0d1f15] border border-white/10 text-white font-light text-sm px-3 py-2 rounded-lg outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-white/30 text-[10px] uppercase mb-1">Urutan</label>
                                        <input type="number" :name="'faqs['+index+'][sort_order]'" x-model="faq.sort_order" class="w-full bg-[#0d1f15] border border-white/10 text-white font-light text-sm px-3 py-2 rounded-lg outline-none">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-white/30 text-[10px] uppercase mb-1">Jawaban</label>
                                    <textarea :name="'faqs['+index+'][answer]'" x-model="faq.answer" rows="3" required class="w-full bg-[#0d1f15] border border-white/10 text-white font-light text-sm px-3 py-2 rounded-lg outline-none resize-y"></textarea>
                                </div>
                            </div>
                        </template>
                        
                        <div x-show="faqs.length === 0" class="text-white/30 text-xs font-light text-center py-6 border border-dashed border-white/10 rounded-xl">
                            Belum ada FAQ khusus untuk layanan ini.
                        </div>
                    </div>
                </div>

                <div class="bg-[#0a1f12] p-5 rounded-xl border border-white/5 space-y-4">
                    <h3 class="text-[#9acb03] text-xs font-semibold uppercase tracking-wider">SEO Metadata</h3>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">{{ old('meta_description', $service->meta_description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $service->meta_keywords) }}" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">OpenGraph Image (Otomatis WebP)</label>
                        @if($service->og_image)
                            <div class="mb-2">
                                <img src="{{ get_image_url($service->og_image) }}" alt="OG Preview" class="h-20 w-auto object-contain rounded border border-white/10 p-1">
                            </div>
                        @endif
                        <input type="file" name="og_image" accept="image/*" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-xs file:bg-[#9acb03] file:text-[#053d33] file:border-0 file:rounded-md file:px-2 file:py-1 file:font-semibold">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-[#0a1f12] p-5 rounded-xl border border-white/5">
                    <label class="block text-white/70 text-xs font-medium mb-3">Featured Image <span class="text-white/30">(Maks 5MB)</span></label>
                    
                    <div x-data="{ preview: '{{ $service->featured_image ? asset('storage/' . $service->featured_image) : '' }}' }" class="space-y-4">
                        <div class="border-2 border-dashed border-white/10 rounded-xl p-4 text-center hover:border-[#9acb03]/50 transition-colors relative cursor-pointer"
                             @click="$refs.file.click()">
                            <template x-if="!preview">
                                <div class="py-4">
                                    <svg class="w-8 h-8 text-white/20 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-xs text-white/50 block">Klik untuk memilih gambar</span>
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
                        <input type="text" name="custom_filename" value="{{ old('custom_filename') }}" placeholder="contoh: jasa-pembuatan-website" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                        <span class="text-white/30 text-[10px]">Jika dikosongkan, nama file akan otomatis mengikuti nama layanan (prefix jasa-).</span>
                    </div>

                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-2">Urutan Tampil</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-full bg-[#0d1f15] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-[#9acb03] transition-all outline-none">
                    </div>
                    
                    <div class="flex items-center gap-3 bg-[#0d1f15] p-3 rounded-lg border border-white/10">
                        <input type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $service->is_active)) class="w-4 h-4 text-[#9acb03] bg-transparent border-white/20 rounded focus:ring-[#9acb03]">
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
