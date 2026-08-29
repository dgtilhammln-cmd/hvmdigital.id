@extends('layouts.admin')
@section('title','Edit — '.$article->title)
@section('page-title','Edit Artikel')

@push('head')
<style>
.cms-card { background: #0d1f15; border: 1px solid rgba(255,255,255,0.06); }
.cms-input { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; }
.cms-input:focus { border-color: rgba(154,203,3,0.5); outline: none; }
.cms-input option { background: #0a1f12; color: #fff; }
.cms-tab-active { color: #9acb03; border-bottom: 2px solid #9acb03; }
.cms-tab-inactive { color: rgba(255,255,255,0.5); border-bottom: 2px solid transparent; }
.cms-tab-inactive:hover { color: rgba(255,255,255,0.8); }
.char-counter { font-size: 11px; transition: color .2s; }
.char-counter.warn { color: #f59e0b; }
.char-counter.danger { color: #ef4444; }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Top Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="text-white/40 text-sm mb-1">
                <a href="{{ route('admin.articles.index') }}" class="hover:text-white transition-colors">Semua Artikel</a>
                <span class="mx-2">›</span>
                <span class="text-white/70">Ubah</span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Ubah Blog Post</h1>
        </div>
        <div class="flex items-center gap-3">
            @if($article->status === 'published')
            <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
               class="text-xs text-[#9acb03] border border-[#9acb03]/30 px-4 py-2 rounded-xl hover:bg-[#9acb03]/10 transition-all flex items-center gap-2 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Website
            </a>
            @endif
            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" id="delete-form">
                @csrf @method('DELETE')
                <button type="button" onclick="if(confirm('Hapus artikel ini secara permanen?')){ document.getElementById('delete-form').submit(); }" 
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium py-2 px-5 rounded-xl transition-all shadow-lg shadow-red-500/20">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    @if($errors->any())
    <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
        <ul class="text-red-400 text-sm space-y-1">@foreach($errors->all() as $e)<li>• {{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" id="article-form">
        @csrf @method('PUT')

        {{-- Main Editor Card --}}
        <div class="cms-card rounded-2xl overflow-hidden shadow-2xl">
            
            {{-- Tabs Navigation --}}
            <div class="flex items-center border-b border-white/5 px-2 pt-2 overflow-x-auto" style="background:#0d1f15">
                <button type="button" onclick="switchTab('content')" id="tab-btn-content" class="tab-btn cms-tab-active px-6 py-4 text-sm font-medium transition-all">Content</button>
                <button type="button" onclick="switchTab('media')" id="tab-btn-media" class="tab-btn cms-tab-inactive px-6 py-4 text-sm font-medium transition-all">Media</button>
                <button type="button" onclick="switchTab('tags')" id="tab-btn-tags" class="tab-btn cms-tab-inactive px-6 py-4 text-sm font-medium transition-all">Tags &amp; Status</button>
                <button type="button" onclick="switchTab('seo')" id="tab-btn-seo" class="tab-btn cms-tab-inactive px-6 py-4 text-sm font-medium transition-all">SEO</button>
            </div>

            {{-- Tab Contents --}}
            <div class="p-6 md:p-8">

                {{-- TAB: CONTENT --}}
                <div id="tab-content" class="tab-pane block space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white/70 text-sm font-medium mb-2">Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title-input" value="{{ old('title', $article->title) }}" required
                                   class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                        </div>
                        <div>
                            <label class="block text-white/70 text-sm font-medium mb-2">Slug <span class="text-red-500">*</span></label>
                            <input type="text" name="slug" id="slug-input" value="{{ old('slug', $article->slug) }}" required
                                   class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                        </div>
                        <div>
                            <label class="block text-white/70 text-sm font-medium mb-2">Category</label>
                            <select name="article_category_id" required class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                                <option value="">— Pilih Kategori —</option>
                                @foreach($categories as $parent)
                                <optgroup label="{{ $parent->name }}" class="bg-[#0d1f15] text-white">
                                    <option value="{{ $parent->id }}" {{ old('article_category_id', $article->article_category_id) == $parent->id ? 'selected' : '' }} class="font-bold text-[#9acb03]">
                                        {{ $parent->name }}
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
                        <div>
                            <label class="block text-white/70 text-sm font-medium mb-2">Author</label>
                            <input type="text" name="author_name" value="{{ old('author_name', $article->author_name ?: session('admin_name', '')) }}"
                                   class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all" placeholder="Nama Penulis">
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-white/70 text-sm font-medium">Content</label>
                            <div class="flex gap-2">
                                <button type="button" id="btn-visual" onclick="switchEditor('visual')"
                                        class="text-xs px-3 py-1.5 rounded-lg bg-white text-black font-semibold shadow-sm transition-all">
                                    👁 Visual Editor
                                </button>
                                <button type="button" id="btn-html" onclick="switchEditor('html')"
                                        class="text-xs px-3 py-1.5 rounded-lg bg-white/5 text-white/50 border border-white/10 hover:bg-white/10 transition-all font-medium">
                                    &lt;/&gt; HTML / Code
                                </button>
                            </div>
                        </div>
                        
                        {{-- Visual Editor (Quill) --}}
                        <div id="visual-editor-wrap" class="rounded-xl overflow-hidden border border-white/10">
                            <div id="editor-container" class="prose max-w-none" style="background: #ffffff; color: #111827; min-height: 500px; font-size: 15px; font-family: 'Montserrat', sans-serif;">
                                {!! old('content', $article->content) !!}
                            </div>
                        </div>

                        {{-- Raw HTML Editor --}}
                        <div id="html-editor-wrap" class="hidden rounded-xl overflow-hidden border border-white/10">
                            <textarea id="content-raw" rows="25"
                                      style="background:#0a1f12;color:#9acb03;width:100%;font-family:monospace;font-size:12px;padding:24px;outline:none;resize:vertical;line-height:1.6;display:block;"></textarea>
                        </div>
                        <input type="hidden" name="content" id="content-input">
                    </div>
                </div>

                {{-- TAB: MEDIA --}}
                <div id="tab-media" class="tab-pane hidden space-y-6">
                    <div>
                        <label class="block text-white/70 text-sm font-medium mb-4">Thumbnail (Featured Image)</label>
                        
                        @if($article->featured_image)
                        <div class="mb-4 relative group inline-block">
                            <img src="{{ get_image_url($article->featured_image_thumb ?? $article->featured_image) }}" alt="Featured" class="max-w-2xl w-full rounded-xl border border-white/10">
                            <div class="absolute top-4 left-4 bg-black/80 backdrop-blur-sm px-3 py-1.5 rounded-lg text-xs font-mono text-white/70 border border-white/10">
                                {{ basename($article->featured_image) }}
                            </div>
                        </div>
                        @endif

                        <div class="border-2 border-dashed border-white/10 bg-white/5/50 rounded-xl p-8 text-center hover:border-[#9acb03]/50 transition-colors cursor-pointer" onclick="document.getElementById('featured-img-input').click()">
                            <input type="file" name="featured_image" id="featured-img-input" accept="image/*" class="hidden" onchange="previewFeaturedImage(this)">
                            <div class="text-white/40 mb-2">
                                <svg class="w-8 h-8 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-sm">Klik untuk upload gambar baru</p>
                                <p class="text-[10px] mt-1 uppercase tracking-wider">Format: JPG, PNG, WEBP</p>
                            </div>
                        </div>
                        <div id="featured-preview" class="hidden mt-4">
                            <img id="featured-preview-img" src="" alt="Preview" class="max-w-2xl w-full rounded-xl border border-white/10">
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-white/5">
                        <label class="block text-white/70 text-sm font-medium mb-2">Custom Filename (Alt Text)</label>
                        <input type="text" name="custom_filename" value="{{ old('custom_filename') }}" placeholder="Contoh: distributor-tenaga-surya-terlengkap" 
                               class="cms-input w-full font-light text-sm px-4 py-3 rounded-xl transition-all">
                        <p class="text-white/30 text-xs mt-2">Deskripsi gambar untuk SEO dan aksesibilitas. Otomatis men-generate nama file baru saat upload.</p>
                    </div>
                </div>

                {{-- TAB: TAGS & STATUS --}}
                <div id="tab-tags" class="tab-pane hidden space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white/70 text-sm font-medium mb-2">Status Publikasi</label>
                            <select name="status" class="cms-input w-full font-light text-sm px-4 py-3 rounded-xl transition-all">
                                <option value="draft" {{ old('status',$article->status)=='draft'?'selected':'' }}>Draft (Sembunyikan)</option>
                                <option value="published" {{ old('status',$article->status)=='published'?'selected':'' }}>Published (Tampilkan ke Publik)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-white/70 text-sm font-medium mb-2">Total Views</label>
                            <div class="w-full bg-white/5 border border-white/5 text-white/50 font-mono text-sm px-4 py-3 rounded-xl">
                                {{ number_format($article->views) }} x dilihat
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-white/5">
                        <label class="block text-white/70 text-sm font-medium mb-2">Excerpt (Ringkasan Artikel)</label>
                        <textarea name="excerpt" id="excerpt-input" rows="4" maxlength="500"
                                  class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"
                                  placeholder="Ringkasan singkat artikel...">{{ old('excerpt', $article->excerpt) }}</textarea>
                    </div>

                    <div class="pt-4 border-t border-white/5">
                        <div class="flex items-center justify-between mb-4">
                            <label class="text-white/70 text-sm font-medium">FAQ (Frequently Asked Questions)</label>
                            <button type="button" onclick="addFaqRow()" class="text-xs px-4 py-2 rounded-lg bg-white/5 text-white/70 hover:bg-white/10 transition-all border border-white/10">
                                + Tambah FAQ
                            </button>
                        </div>
                        <div id="faq-container" class="space-y-4">
                            @php $oldFaqs = old('faqs', is_array($article->faqs) ? $article->faqs : []); @endphp
                            @foreach($oldFaqs as $index => $faq)
                            <div class="faq-row bg-white/5/50 border border-white/10 rounded-xl p-5 relative">
                                <button type="button" onclick="this.closest('.faq-row').remove()" class="absolute top-4 right-4 text-white/20 hover:text-red-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                <input type="text" name="faqs[{{ $index }}][question]" value="{{ $faq['question'] ?? '' }}" placeholder="Pertanyaan FAQ..." class="w-full bg-transparent border-b border-white/10 text-white font-medium text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all mb-4">
                                <textarea name="faqs[{{ $index }}][answer]" rows="2" placeholder="Jawaban FAQ..." class="w-full bg-transparent border-b border-white/10 text-white/70 font-light text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all resize-y"></textarea>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- TAB: SEO --}}
                <div id="tab-seo" class="tab-pane hidden space-y-6">
                    <div>
                        <label class="block text-white/70 text-sm font-medium mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta-title-input" value="{{ old('meta_title', $article->getRawOriginal('meta_title')) }}" maxlength="255"
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all" placeholder="Kosongkan untuk otomatis menggunakan Judul">
                    </div>
                    <div>
                        <label class="block text-white/70 text-sm font-medium mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta-desc-input" rows="3" maxlength="320"
                                  class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none" placeholder="Kosongkan untuk otomatis menggunakan Excerpt">{{ old('meta_description', $article->getRawOriginal('meta_description')) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-white/70 text-sm font-medium mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $article->meta_keywords) }}"
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all" placeholder="keyword1, keyword2, keyword3">
                    </div>
                    
                    <div class="pt-4 border-t border-white/5">
                        <label class="block text-white/70 text-sm font-medium mb-4">OG Image (Sosial Media Share)</label>
                        @if($article->og_image)
                        <div class="mb-4">
                            <img src="{{ get_image_url($article->og_image) }}" alt="OG Image" class="max-w-md w-full rounded-xl border border-white/10">
                        </div>
                        @endif
                        <div class="border-2 border-dashed border-white/10 bg-white/5/50 rounded-xl p-6 text-center hover:border-[#9acb03]/50 transition-colors cursor-pointer" onclick="document.getElementById('og-image-input').click()">
                            <input type="file" name="og_image" id="og-image-input" accept="image/*" class="hidden" onchange="previewOgImage(this)">
                            <div class="text-white/40">
                                <p class="text-sm">Upload gambar OG kustom (Opsional)</p>
                                <p class="text-[10px] mt-1 uppercase tracking-wider">Rekomendasi ukuran: 1200x630px</p>
                            </div>
                        </div>
                        <div id="og-preview" class="hidden mt-4">
                            <img id="og-preview-img" src="" alt="OG Preview" class="max-w-md w-full rounded-xl border border-white/10">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/5">
                        <label class="block text-white/70 text-sm font-medium mb-4">Google SERP Preview</label>
                        <div class="bg-white rounded-xl p-5 border border-gray-200 w-full max-w-2xl">
                            <div class="text-[#1a0dab] text-[20px] leading-tight mb-1 font-normal truncate" id="serp-title">{{ $article->getRawOriginal('meta_title') ?: $article->title }}</div>
                            <div class="text-[#006621] text-[14px] leading-tight mb-1 truncate">hvm-digital.id › artikel › <span id="serp-slug">{{ $article->slug }}</span></div>
                            <div class="text-[#545454] text-[14px] leading-snug line-clamp-2" id="serp-desc">{{ $article->getRawOriginal('meta_description') ?: $article->excerpt }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Fixed Bottom Actions --}}
        <div class="mt-8 flex gap-4 pb-12">
            <button type="submit" class="bg-[#9acb03] hover:bg-[#86b303] text-[#053d33] font-bold text-sm px-8 py-3.5 rounded-xl transition-all shadow-lg shadow-[#9acb03]/20">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.articles.index') }}" class="bg-white/5 hover:bg-[#374151] text-white/70 font-medium text-sm px-8 py-3.5 rounded-xl transition-all border border-white/10">
                Batal
            </a>
        </div>
    </form>
</div>

<style>
/* Quill Overrides for this layout */
.ql-toolbar.ql-snow {
    background: #f8fafc;
    border: none;
    border-bottom: 1px solid #e2e8f0;
    padding: 12px 16px;
    font-family: inherit;
}
.ql-container.ql-snow {
    border: none;
}
.ql-editor {
    padding: 40px;
    line-height: 1.8;
}
.ql-editor h1 { font-size: 2.25em; font-weight: 800; margin-top: 1.5em; margin-bottom: 0.8em; color: #000; line-height: 1.2; }
.ql-editor h2 { font-size: 1.75em; font-weight: 700; margin-top: 1.5em; margin-bottom: 0.8em; color: #000; line-height: 1.3; }
.ql-editor h3 { font-size: 1.35em; font-weight: 700; margin-top: 1.2em; margin-bottom: 0.6em; color: #111827; line-height: 1.4; }
.ql-editor p { margin-bottom: 1.2em; }
.ql-editor ul, .ql-editor ol { margin-bottom: 1.2em; padding-left: 1.5em; }
.ql-editor li { margin-bottom: 0.5em; }
.ql-editor a { color: #075749; text-decoration: underline; font-weight: 600; }
.ql-editor blockquote { border-left: 4px solid #9acb03; padding-left: 1rem; color: #4b5563; font-style: italic; margin: 1.5em 0; }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
// Tab Logic
function switchTab(tabId) {
    document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('cms-tab-active');
        el.classList.add('cms-tab-inactive');
    });

    document.getElementById('tab-' + tabId).classList.remove('hidden');
    const btn = document.getElementById('tab-btn-' + tabId);
    btn.classList.remove('cms-tab-inactive');
    btn.classList.add('cms-tab-active');
}

// Editor Logic
let quill;
let currentMode = 'visual';

function initEditor() {
    quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Ketik isi artikel dengan profesional di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
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

    // Auto-convert legacy markdown
    let content = quill.root.innerHTML;
    if (content && content.includes('##') && !content.includes('<h2')) {
        let textContent = document.getElementById('editor-container').innerText || '';
        if(textContent.includes('##')) {
            let parsed = marked.parse(textContent);
            quill.clipboard.dangerouslyPasteHTML(parsed);
        }
    }
}

function switchEditor(mode) {
    currentMode = mode;
    const visualWrap = document.getElementById('visual-editor-wrap');
    const htmlWrap   = document.getElementById('html-editor-wrap');
    const btnVisual  = document.getElementById('btn-visual');
    const btnHtml    = document.getElementById('btn-html');
    const rawInput   = document.getElementById('content-raw');

    if (mode === 'html') {
        visualWrap.classList.add('hidden');
        htmlWrap.classList.remove('hidden');
        btnHtml.className   = 'text-xs px-3 py-1.5 rounded-lg bg-white text-black font-semibold shadow-sm transition-all';
        btnVisual.className = 'text-xs px-3 py-1.5 rounded-lg bg-white/5 text-white/50 border border-white/10 hover:bg-white/10 transition-all font-medium';
        rawInput.value = quill.root.innerHTML;
    } else {
        htmlWrap.classList.add('hidden');
        visualWrap.classList.remove('hidden');
        btnVisual.className = 'text-xs px-3 py-1.5 rounded-lg bg-white text-black font-semibold shadow-sm transition-all';
        btnHtml.className   = 'text-xs px-3 py-1.5 rounded-lg bg-white/5 text-white/50 border border-white/10 hover:bg-white/10 transition-all font-medium';
        quill.clipboard.dangerouslyPasteHTML(rawInput.value);
    }
}

document.getElementById('article-form').addEventListener('submit', function() {
    if (currentMode === 'visual') {
        document.getElementById('content-input').value = quill.root.innerHTML;
    } else {
        document.getElementById('content-input').value = document.getElementById('content-raw').value;
    }
});

// FAQ Logic
let faqIndex = {{ count(old('faqs', is_array($article->faqs) ? $article->faqs : [])) }};
function addFaqRow() {
    const container = document.getElementById('faq-container');
    const row = document.createElement('div');
    row.className = 'faq-row bg-white/5/50 border border-white/10 rounded-xl p-5 relative';
    row.innerHTML = `
        <button type="button" onclick="this.closest('.faq-row').remove()" class="absolute top-4 right-4 text-white/20 hover:text-red-400 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <input type="text" name="faqs[${faqIndex}][question]" placeholder="Pertanyaan FAQ..." class="w-full bg-transparent border-b border-white/10 text-white font-medium text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all mb-4">
        <textarea name="faqs[${faqIndex}][answer]" rows="2" placeholder="Jawaban FAQ..." class="w-full bg-transparent border-b border-white/10 text-white/70 font-light text-sm px-0 py-2 focus:outline-none focus:border-[#9acb03]/50 transition-all resize-y"></textarea>
    `;
    container.appendChild(row);
    faqIndex++;
}

// Media Previews
function previewFeaturedImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { 
            document.getElementById('featured-preview-img').src = e.target.result; 
            document.getElementById('featured-preview').classList.remove('hidden'); 
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function previewOgImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { 
            document.getElementById('og-preview-img').src = e.target.result; 
            document.getElementById('og-preview').classList.remove('hidden'); 
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// SERP Preview
function updateSerp() {
    const title  = document.getElementById('title-input').value;
    const metaT  = document.getElementById('meta-title-input').value || title;
    const desc   = document.getElementById('meta-desc-input').value || document.getElementById('excerpt-input').value;
    const slug   = document.getElementById('slug-input').value.trim() || 'slug-artikel';
    
    const serpTitle = document.getElementById('serp-title');
    if (serpTitle) serpTitle.textContent = metaT.substring(0, 60);
    
    const serpDesc = document.getElementById('serp-desc');
    if (serpDesc) serpDesc.textContent  = desc.substring(0, 160);
    
    const serpSlug = document.getElementById('serp-slug');
    if (serpSlug) serpSlug.textContent  = slug;
}

document.addEventListener('DOMContentLoaded', function() {
    initEditor();
    
    ['title-input','slug-input','excerpt-input','meta-title-input','meta-desc-input'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', updateSerp);
    });
    updateSerp();
});
</script>
@endpush
@endsection
