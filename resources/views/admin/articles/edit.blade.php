@extends('layouts.admin')
@section('title','Edit — '.$article->title)
@section('page-title','Edit Artikel')

@push('head')
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
<style>
.EasyMDEContainer .CodeMirror { background: rgba(255,255,255,0.03); color: #e2e8f0; border-color: rgba(255,255,255,0.1); min-height: 400px; font-family: 'Fira Code', monospace; font-size: 13px; }
.EasyMDEContainer .editor-toolbar { background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.1); }
.EasyMDEContainer .editor-toolbar button { color: rgba(255,255,255,0.5) !important; }
.EasyMDEContainer .editor-toolbar button:hover, .EasyMDEContainer .editor-toolbar button.active { background: rgba(255,255,255,0.1); color: white !important; }
.EasyMDEContainer .editor-preview { background: #111827; color: #e2e8f0; }
.EasyMDEContainer .editor-preview h1,.EasyMDEContainer .editor-preview h2,.EasyMDEContainer .editor-preview h3 { color: #9acb03; }
.char-counter { font-size: 11px; transition: color .2s; }
.char-counter.warn { color: #f59e0b; }
.char-counter.danger { color: #ef4444; }
</style>
@endpush

@section('content')
<div class="max-w-5xl">
    {{-- Breadcrumb + Stats bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-3 flex-wrap">
            <a href="{{ route('admin.articles.index') }}" class="text-white/40 hover:text-white/70 text-sm transition-colors">← Semua Artikel</a>
            <span class="text-white/20">/</span>
            <span class="text-white/60 text-sm truncate max-w-xs">{{ Str::limit($article->title, 40) }}</span>
        </div>
        <div class="flex items-center gap-4">
            {{-- Stats --}}
            <div class="flex items-center gap-1.5 bg-white/5 border border-white/10 rounded-xl px-4 py-2">
                <svg class="w-3.5 h-3.5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span class="text-white/60 text-xs font-light">{{ number_format($article->views) }} views</span>
            </div>
            @if($article->status === 'published')
            <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
               class="flex items-center gap-1.5 text-xs text-[#9acb03] border border-[#9acb03]/30 px-3 py-2 rounded-xl hover:bg-[#9acb03]/10 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Preview Publik
            </a>
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" id="article-form" class="space-y-6">
        @csrf @method('PUT')

        @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
            <ul class="text-red-400 text-sm space-y-1">@foreach($errors->all() as $e)<li>• {{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ===== MAIN COLUMN ===== --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Judul & Slug --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-4">
                    <div>
                        <label class="block text-white/50 text-xs font-medium tracking-wider uppercase mb-2">Judul Artikel *</label>
                        <input type="text" name="title" id="title-input" value="{{ old('title', $article->title) }}" required
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-lg px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                    </div>
                    <div>
                        <label class="block text-white/50 text-xs font-medium tracking-wider uppercase mb-2">Slug URL</label>
                        <input type="text" name="slug" id="slug-input" value="{{ old('slug', $article->slug) }}" required
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                        <p class="text-white/20 text-xs mt-2 font-light">Anda dapat mengedit slug URL secara manual.</p>
                    </div>
                </div>

                {{-- Excerpt --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-white/50 text-xs font-medium tracking-wider uppercase">Ringkasan / Excerpt</label>
                        <span id="excerpt-counter" class="char-counter text-white/30">0/500</span>
                    </div>
                    <textarea name="excerpt" id="excerpt-input" rows="3" maxlength="500"
                              class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"
                              placeholder="Ringkasan singkat artikel...">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>

                {{-- KONTEN - QuillJS Editor --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-white/50 text-xs font-medium tracking-wider uppercase">Konten Artikel</label>
                    </div>
                    <div id="editor-container" style="background: #ffffff; color: #111827; border-radius: 0 0 16px 16px; min-height: 400px; font-size: 15px; font-family: 'Montserrat', sans-serif;">
                        {!! old('content', $article->content) !!}
                    </div>
                    <input type="hidden" name="content" id="content-input">
                    <style>
                        .ql-toolbar.ql-snow {
                            background: #f9fafb;
                            border: none;
                            border-bottom: 1px solid #e5e7eb;
                            border-radius: 16px 16px 0 0;
                            padding: 12px;
                        }
                        .ql-container.ql-snow {
                            border: none;
                        }
                        .ql-editor {
                            min-height: 400px;
                            padding: 20px 24px;
                        }
                        .ql-editor h2 { font-size: 1.5em; font-weight: 700; margin-bottom: 0.5em; color: #111827; }
                        .ql-editor h3 { font-size: 1.25em; font-weight: 600; margin-bottom: 0.5em; color: #111827; }
                        .ql-editor p { margin-bottom: 1em; line-height: 1.6; }
                        .ql-editor a { color: #075749; text-decoration: underline; }
                        /* Fix fullscreen overlap */
                        .ql-container.ql-snow.ql-fullscreen {
                            position: fixed !important;
                            top: 0 !important;
                            left: 0 !important;
                            width: 100vw !important;
                            height: 100vh !important;
                            z-index: 9999 !important;
                            background: white;
                        }
                        .ql-toolbar.ql-fullscreen {
                            position: fixed !important;
                            top: 0 !important;
                            left: 0 !important;
                            width: 100vw !important;
                            z-index: 10000 !important;
                            background: #f9fafb;
                        }
                    </style>
                </div>

                {{-- FAQs --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-white/50 text-xs font-medium tracking-wider uppercase">Pertanyaan Sering Diajukan (FAQ)</label>
                        <button type="button" onclick="addFaqRow()" class="text-xs px-3 py-1.5 rounded-lg bg-white/5 text-white/50 hover:bg-white/10 hover:text-white transition-all border border-white/10">
                            + Tambah FAQ
                        </button>
                    </div>
                    <div id="faq-container" class="space-y-4">
                        @php $oldFaqs = old('faqs', is_array($article->faqs) ? $article->faqs : []); @endphp
                        @foreach($oldFaqs as $index => $faq)
                        <div class="faq-row bg-white/5 border border-white/10 rounded-xl p-4 relative">
                            <button type="button" onclick="this.closest('.faq-row').remove()" class="absolute top-4 right-4 text-white/20 hover:text-red-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            <input type="text" name="faqs[{{ $index }}][question]" value="{{ $faq['question'] ?? '' }}" placeholder="Pertanyaan..." class="w-full bg-transparent border-b border-white/10 text-white font-medium text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all mb-3">
                            <textarea name="faqs[{{ $index }}][answer]" rows="2" placeholder="Jawaban..." class="w-full bg-transparent border-b border-white/10 text-white/70 font-light text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none">{{ $faq['answer'] ?? '' }}</textarea>
                        </div>
                        @endforeach
                    </div>
                </div>


                {{-- SEO Panel --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-4">
                    <h3 class="text-[#9acb03] text-xs font-semibold tracking-widest uppercase flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        SEO & Open Graph Settings
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <div class="flex justify-between mb-1.5">
                                <label class="text-white/40 text-xs">Meta Title <span class="text-white/20">(max 60 karakter)</span></label>
                                <span id="mtitle-counter" class="char-counter text-white/30">0/60</span>
                            </div>
                            <input type="text" name="meta_title" id="meta-title-input" value="{{ old('meta_title', $article->getRawOriginal('meta_title')) }}" maxlength="255"
                                   class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                                   placeholder="Kosongkan = auto dari judul artikel">
                        </div>
                        <div>
                            <div class="flex justify-between mb-1.5">
                                <label class="text-white/40 text-xs">Meta Description <span class="text-white/20">(ideal 150-160 karakter)</span></label>
                                <span id="mdesc-counter" class="char-counter text-white/30">0/160</span>
                            </div>
                            <textarea name="meta_description" id="meta-desc-input" rows="2" maxlength="320"
                                      class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"
                                      placeholder="Kosongkan = auto dari excerpt...">{{ old('meta_description', $article->getRawOriginal('meta_description')) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-white/40 text-xs mb-1.5">Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $article->meta_keywords) }}"
                                   class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                                   placeholder="keyword1, keyword2, keyword3">
                        </div>
                        {{-- OG Image --}}
                        <div class="border-t border-white/5 pt-4">
                            <label class="block text-white/40 text-xs mb-2">OG Image (untuk share WhatsApp, FB — ideal 1200×630px)</label>
                            @if($article->og_image)
                            <div class="mb-3">
                                <img src="{{ get_image_url($article->og_image) }}" alt="OG Image" class="w-full max-w-sm rounded-xl opacity-70">
                                <p class="text-white/30 text-xs mt-1">OG Image saat ini</p>
                            </div>
                            @endif
                            <div class="border-2 border-dashed border-white/10 rounded-xl p-4 text-center hover:border-[#9acb03]/30 transition-colors">
                                <input type="file" name="og_image" id="og-image-input" accept="image/*" class="hidden" onchange="previewOgImage(this)">
                                <label for="og-image-input" class="cursor-pointer text-xs px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white/50 transition-all">
                                    {{ $article->og_image ? 'Ganti OG Image' : 'Upload OG Image' }}
                                </label>
                            </div>
                            <div id="og-preview" class="mt-3 hidden">
                                <img id="og-preview-img" src="" alt="OG Preview" class="w-full max-w-sm rounded-xl opacity-80">
                            </div>
                        </div>
                    </div>

                    {{-- SERP Preview --}}
                    <div class="bg-white/3 rounded-xl p-4 border border-white/5">
                        <p class="text-white/30 text-[10px] uppercase tracking-widest mb-3 font-medium">Google SERP Preview</p>
                        <div class="text-blue-400 text-base font-medium leading-tight mb-1" id="serp-title">{{ $article->getRawOriginal('meta_title') ?: $article->title }}</div>
                        <div class="text-green-500 text-xs mb-1">hvm-digital.id › artikel › <span id="serp-slug">{{ $article->slug }}</span></div>
                        <div class="text-gray-300 text-sm font-light leading-relaxed" id="serp-desc">{{ $article->getRawOriginal('meta_description') ?: $article->excerpt }}</div>
                    </div>
                </div>
            </div>

            {{-- ===== SIDEBAR ===== --}}
            <div class="space-y-5">
                {{-- Stats --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
                    <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase mb-4"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg> Statistik Artikel</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-white/40 text-xs">Total Views</span>
                            <span class="text-[#9acb03] font-bold text-lg">{{ number_format($article->views) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-white/40 text-xs">Status</span>
                            <span class="text-xs px-2.5 py-1 rounded-full font-medium {{ $article->status==='published' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                                {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                        @if($article->published_at)
                        <div class="flex justify-between items-center">
                            <span class="text-white/40 text-xs">Published</span>
                            <span class="text-white/50 text-xs">{{ $article->published_at->format('d M Y') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <span class="text-white/40 text-xs">Last Update</span>
                            <span class="text-white/50 text-xs">{{ $article->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                {{-- Publish --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-4">
                    <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase">Publish</h3>
                    <div>
                        <label class="block text-white/40 text-xs mb-1.5">Penulis / Author (Opsional)</label>
                        <input type="text" name="author_name" value="{{ old('author_name', $article->author_name ?: session('admin_name', '')) }}"
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                               placeholder="Nama Penulis">
                    </div>
                    <div>
                        <label class="block text-white/40 text-xs mb-1.5">Status</label>
                        <select name="status" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                            <option value="draft" {{ old('status',$article->status)=='draft'?'selected':'' }}>📋 Draft</option>
                            <option value="published" {{ old('status',$article->status)=='published'?'selected':'' }}>🚀 Published</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white/40 text-xs mb-1.5">Kategori Artikel</label>
                        <select name="article_category_id" required class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $parent)
                            <optgroup label="{{ $parent->name }}" class="bg-[#0a1f12] text-white">
                                <option value="{{ $parent->id }}" {{ old('article_category_id', $article->article_category_id) == $parent->id ? 'selected' : '' }} class="font-bold text-[#9acb03]">
                                    {{ $parent->name }} (Kategori Utama)
                                </option>
                                @foreach($parent->children as $child)
                                <option value="{{ $child->id }}" {{ old('article_category_id', $article->article_category_id) == $child->id ? 'selected' : '' }} class="pl-4">
                                    — {{ $child->name }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('admin.articles.index') }}"
                           class="flex-1 text-center border border-white/10 text-white/50 font-light text-sm px-4 py-3 rounded-xl hover:border-white/20 transition-all">
                            Batal
                        </a>
                        <button type="submit"
                                class="flex-1 text-[#053d33] font-semibold text-sm px-4 py-3 rounded-xl hover:scale-105 transition-all"
                                style="background: linear-gradient(135deg, #9acb03, #b8e832);">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Update
                        </button>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-3">
                    <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase">Featured Image & Penamaan SEO</h3>
                    
                    <div>
                        <label class="block text-white/70 text-xs font-medium mb-1.5">Nama File Gambar <span class="text-white/30">(Opsional)</span></label>
                        <input type="text" name="custom_filename" value="{{ old('custom_filename') }}" placeholder="contoh: artikel-tips-seo" class="w-full bg-[#0a1f12] border border-white/10 rounded-xl px-3 py-2 text-white text-xs focus:border-[#9acb03] transition-all outline-none">
                        <span class="text-white/20 text-[10px] mt-1 block">Jika kosong, otomatis di-generate berdasarkan Judul Artikel. Suffix -og otomatis ditambahkan ke gambar OG.</span>
                    </div>

                    @if($article->featured_image)
                    <img src="{{ get_image_url($article->featured_image_thumb ?? $article->featured_image) }}" alt="Featured" class="w-full rounded-xl opacity-70">
                    @endif
                    <div class="border-2 border-dashed border-white/10 rounded-xl p-4 text-center hover:border-[#9acb03]/30 transition-colors">
                        <input type="file" name="featured_image" id="featured-img-input" accept="image/*" class="hidden" onchange="previewFeaturedImage(this)">
                        <label for="featured-img-input" class="cursor-pointer text-xs px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white/50 transition-all">
                            {{ $article->featured_image ? 'Ganti Gambar' : 'Upload Gambar' }}
                        </label>
                    </div>
                    <div id="featured-preview" class="hidden">
                        <img id="featured-preview-img" src="" alt="Preview" class="w-full rounded-xl opacity-80">
                    </div>
                    <p class="text-white/20 text-[11px] font-light">Auto convert ke WebP</p>
                </div>
            </div>
        </div>
    </form>
    
    {{-- Delete Form (outside main form) --}}
    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" id="delete-form" class="mt-4 text-right">
        @csrf @method('DELETE')
        <button type="button" onclick="if(confirm('Hapus artikel ini secara permanen?')){ document.getElementById('delete-form').submit(); }" 
                class="text-red-400/50 hover:text-red-400 text-xs py-2 px-4 hover:bg-red-500/10 rounded-xl transition-all">
            🗑 Hapus Artikel Permanen
        </button>
    </form>
</div>

@push('scripts')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
let quill;

function initEditor() {
    quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Tulis isi artikel di sini...',
        modules: {
            toolbar: [
                [{ 'header': [2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image', 'video'],
                ['clean']
            ],
            keyboard: {
                bindings: {
                    link: {
                        key: 'k',
                        shortKey: true,
                        handler: function(range, context) {
                            var value = prompt('Masukkan URL hyperlink:');
                            if (value) {
                                this.quill.format('link', value);
                            }
                        }
                    }
                }
            }
        }
    });
}

document.getElementById('article-form').addEventListener('submit', function() {
    // Save Quill content to hidden input
    document.getElementById('content-input').value = quill.root.innerHTML;
});

function setupCounter(inputId, counterId, max, warnAt) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    if (!input || !counter) return;
    function update() {
        const len = input.value.length;
        counter.textContent = len + '/' + max;
        counter.className = 'char-counter ' + (len > max ? 'danger' : len > warnAt ? 'warn' : 'text-white/30');
    }
    input.addEventListener('input', update);
    update();
}

function updateSerp() {
    const title  = document.getElementById('title-input').value;
    const metaT  = document.getElementById('meta-title-input').value || title;
    const desc   = document.getElementById('meta-desc-input').value || document.getElementById('excerpt-input').value;
    const slug   = document.getElementById('slug-input').value.trim() || 'slug-artikel';
    document.getElementById('serp-title').textContent = metaT.substring(0, 60);
    document.getElementById('serp-desc').textContent  = desc.substring(0, 160);
    document.getElementById('serp-slug').textContent  = slug;
}

function previewFeaturedImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { document.getElementById('featured-preview-img').src = e.target.result; document.getElementById('featured-preview').classList.remove('hidden'); };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewOgImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { document.getElementById('og-preview-img').src = e.target.result; document.getElementById('og-preview').classList.remove('hidden'); };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initEditor();
    setupCounter('excerpt-input',   'excerpt-counter', 500, 400);
    setupCounter('meta-title-input','mtitle-counter',   60,  50);
    setupCounter('meta-desc-input', 'mdesc-counter',   160, 130);
    ['title-input','slug-input','excerpt-input','meta-title-input','meta-desc-input'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', updateSerp);
    });
    updateSerp();
});

// FAQ Repeater
let faqIndex = {{ count(old('faqs', is_array($article->faqs) ? $article->faqs : [])) }};
function addFaqRow() {
    const container = document.getElementById('faq-container');
    const row = document.createElement('div');
    row.className = 'faq-row bg-white/5 border border-white/10 rounded-xl p-4 relative';
    row.innerHTML = `
        <button type="button" onclick="this.closest('.faq-row').remove()" class="absolute top-4 right-4 text-white/20 hover:text-red-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <input type="text" name="faqs[${faqIndex}][question]" placeholder="Pertanyaan..." class="w-full bg-transparent border-b border-white/10 text-white font-medium text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all mb-3">
        <textarea name="faqs[${faqIndex}][answer]" rows="2" placeholder="Jawaban..." class="w-full bg-transparent border-b border-white/10 text-white/70 font-light text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"></textarea>
    `;
    container.appendChild(row);
    faqIndex++;
}
</script>
@endpush
@endsection
