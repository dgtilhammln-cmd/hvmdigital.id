@extends('layouts.admin')
@section('title', 'Edit SEO & FAQ - ' . $pageInfo['name'])
@section('page-title', 'Edit SEO & FAQ')
@section('page-subtitle', $pageInfo['name'] . ' — ' . $pageInfo['desc'])

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.page-management.update-core', $pageKey) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- SEO Metadata Card -->
        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-4">
            <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg> SEO Settings & Meta Tags</h3>
            
            <div>
                <label class="block text-white/40 text-xs mb-1.5">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $metaTitle) }}" placeholder="Meta Title Halaman..." class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
            </div>
            
            <div>
                <label class="block text-white/40 text-xs mb-1.5">Meta Description</label>
                <textarea name="meta_description" rows="3" placeholder="Deskripsi meta untuk mesin pencari..." class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none">{{ old('meta_description', $metaDescription) }}</textarea>
            </div>
            
            <div>
                <label class="block text-white/40 text-xs mb-1.5">Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $metaKeywords) }}" placeholder="keyword1, keyword2, keyword3..." class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
            </div>

            <!-- OpenGraph Image Uploader -->
            <div class="pt-4 border-t border-white/5">
                <label class="block text-white/40 text-xs mb-2">OpenGraph Image (Rekomendasi 1200x630px, otomatis dikompresi ke WebP)</label>
                @if($ogImage)
                    <div class="mb-3">
                        <img src="{{ get_image_url($ogImage) }}" alt="Preview OG" class="h-32 w-auto object-contain rounded-xl border border-white/10 bg-black/20 p-2">
                    </div>
                @endif
                <input type="file" name="og_image" accept="image/*" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#9acb03] file:text-[#0a1f12] hover:file:bg-[#9acb03]/80">
            </div>
        </div>

        <!-- FAQ Management Section -->
        <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-4" x-data="{ 
            faqs: {{ json_encode($faqs) }},
            addFaq() {
                this.faqs.push({ id: null, question: '', answer: '', sort_order: this.faqs.length, is_active: 1 });
            },
            removeFaq(index) {
                this.faqs.splice(index, 1);
            }
        }">
            <div class="flex items-center justify-between">
                <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> FAQ Halaman</h3>
                <button type="button" @click="addFaq()" class="bg-[#9acb03]/10 hover:bg-[#9acb03]/20 border border-[#9acb03]/30 text-[#9acb03] text-xs px-3 py-1.5 rounded-lg transition-all">+ Tambah FAQ</button>
            </div>
            
            <div class="space-y-4">
                <template x-for="(faq, index) in faqs" :key="index">
                    <div class="bg-black/20 border border-white/5 rounded-xl p-4 space-y-3 relative">
                        <button type="button" @click="removeFaq(index)" class="absolute top-3 right-3 text-red-400 hover:text-red-500 text-xs" title="Hapus FAQ">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                        
                        <input type="hidden" :name="'faqs['+index+'][id]'" :value="faq.id">
                        
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <div class="md:col-span-3">
                                <label class="block text-white/30 text-[10px] uppercase mb-1">Pertanyaan (Question)</label>
                                <input type="text" :name="'faqs['+index+'][question]'" x-model="faq.question" required class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-3 py-2 rounded-lg focus:outline-none focus:border-[#9acb03]/50 transition-all">
                            </div>
                            <div>
                                <label class="block text-white/30 text-[10px] uppercase mb-1">Urutan (Sort Order)</label>
                                <input type="number" :name="'faqs['+index+'][sort_order]'" x-model="faq.sort_order" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-3 py-2 rounded-lg focus:outline-none focus:border-[#9acb03]/50 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-white/30 text-[10px] uppercase mb-1">Jawaban (Answer)</label>
                            <textarea :name="'faqs['+index+'][answer]'" x-model="faq.answer" rows="3" required class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-3 py-2 rounded-lg focus:outline-none focus:border-[#9acb03]/50 transition-all resize-y"></textarea>
                        </div>
                    </div>
                </template>
                
                <div x-show="faqs.length === 0" class="text-white/30 text-xs font-light text-center py-6 border border-dashed border-white/10 rounded-xl">
                    Belum ada FAQ khusus untuk halaman ini. Klik "+ Tambah FAQ" di atas untuk menambahkan.
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex gap-3">
            <a href="{{ route('admin.page-management.index') }}" class="border border-white/10 text-white/50 font-light text-sm px-6 py-3 rounded-xl hover:border-white/20 transition-all">← Kembali</a>
            <button type="submit" class="bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold px-8 py-3 rounded-xl hover:scale-105 transition-all"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg> Simpan</button>
            <a href="{{ $pageKey === 'home' ? url('/') : ($pageKey === 'services.seo' ? route('services.seo') : route(str_replace('.index', '', $pageKey))) }}" target="_blank" class="border border-[#9acb03]/20 text-[#9acb03] font-light text-sm px-6 py-3 rounded-xl hover:bg-[#9acb03]/5 transition-all"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> Preview</a>
        </div>
    </form>
</div>
@endsection
