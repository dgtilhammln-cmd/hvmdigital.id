@extends('layouts.admin')
@section('title','Tambah Artikel')
@section('page-title','Tambah Artikel Baru')

@push('head')
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
<style>
.EasyMDEContainer .CodeMirror { background: #f9fafb; color: #111827; border-color: #e5e7eb; min-height: 400px; font-family: 'Fira Code', monospace; font-size: 13px; }
.EasyMDEContainer .editor-toolbar { background: #f9fafb; border-color: #e5e7eb; }
.EasyMDEContainer .editor-toolbar button { color: #6b7280 !important; }
.EasyMDEContainer .editor-toolbar button:hover, .EasyMDEContainer .editor-toolbar button.active { background: #e5e7eb; color: #111827 !important; }
.EasyMDEContainer .editor-preview { background: #fff; color: #111827; }
.EasyMDEContainer .editor-preview h1,.EasyMDEContainer .editor-preview h2,.EasyMDEContainer .editor-preview h3 { color: #075749; }
.char-counter { font-size: 11px; transition: color .2s; }
.char-counter.warn { color: #f59e0b; }
.char-counter.danger { color: #ef4444; }

/* Smart Category Suggester */
#cat-suggestions { animation: fadeIn .2s ease; }
@keyframes fadeIn { from{opacity:0;transform:translateY(-4px)} to{opacity:1;transform:translateY(0)} }
.cat-suggestion-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    cursor: pointer;
    transition: all .15s;
    margin-bottom: 6px;
    gap: 10px;
}
.cat-suggestion-item:hover { background: #f0fdf4; border-color: #9acb03; }
.cat-suggestion-item.top-pick { border-color: #9acb03; background: #f0fdf4; }
.cat-score-bar { height: 4px; border-radius: 2px; background: #e5e7eb; flex-shrink: 0; width: 60px; overflow:hidden; }
.cat-score-fill { height: 100%; border-radius: 2px; background: linear-gradient(90deg,#9acb03,#075749); transition: width .3s; }
</style>
@endpush

@section('content')
@php
$catJson = json_encode($categories->map(function($p) {
    return [
        'id'       => $p->id,
        'name'     => $p->name,
        'children' => $p->children->map(function($c) {
            return ['id' => $c->id, 'name' => $c->name];
        })->values()->toArray(),
    ];
})->values()->toArray());
@endphp
<div class="max-w-5xl">
    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" id="article-form" class="space-y-6">
        @csrf

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
                        <input type="text" name="title" id="title-input" value="{{ old('title') }}" required
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-lg px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                               placeholder="Judul artikel yang menarik...">
                    </div>
                    <div>
                        <label class="block text-white/50 text-xs font-medium tracking-wider uppercase mb-2">Slug URL (Opsional)</label>
                        <input type="text" name="slug" id="slug-input" value="{{ old('slug') }}"
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                               placeholder="contoh-slug-artikel-manual">
                        <p class="text-white/20 text-xs mt-2 font-light">Kosongkan jika ingin slug di-generate otomatis dari judul.</p>
                    </div>
                </div>

                {{-- Excerpt --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <label class="text-white/50 text-xs font-medium tracking-wider uppercase">Ringkasan / Excerpt</label>
                        <span id="excerpt-counter" class="char-counter text-white/30">0/500</span>
                    </div>
                    <textarea name="excerpt" id="excerpt-input" rows="3" maxlength="500"
                              class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"
                              placeholder="Ringkasan singkat artikel (tampil di list & Google preview)...">{{ old('excerpt') }}</textarea>
                </div>

                {{-- KONTEN - EasyMDE Editor --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-white/50 text-xs font-medium tracking-wider uppercase">Konten Artikel</label>
                        <div class="flex gap-2">
                            <button type="button" id="btn-md" onclick="switchEditorMode('markdown')"
                                    class="text-xs px-3 py-1.5 rounded-lg bg-[#9acb03]/20 text-[#9acb03] border border-[#9acb03]/30 font-medium">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Markdown
                            </button>
                            <button type="button" id="btn-html" onclick="switchEditorMode('html')"
                                    class="text-xs px-3 py-1.5 rounded-lg bg-white/5 text-white/40 border border-white/10 font-medium">
                                &lt;/&gt; HTML/Code
                            </button>
                        </div>
                    </div>

                    {{-- Markdown Editor --}}
                    <div id="md-editor-wrap">
                        <textarea id="content-md" name="content_md">{{ old('content') }}</textarea>
                    </div>

                    {{-- Raw HTML/Code Editor --}}
                    <div id="html-editor-wrap" class="hidden">
                        <textarea name="content" id="content-raw" rows="20"
                                  class="w-full bg-black/40 border border-white/10 text-green-400 font-mono text-xs px-4 py-4 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-y"
                                  placeholder="Tulis HTML/code langsung di sini...&#10;&#10;<h2>Judul Section</h2>&#10;<p>Paragraf konten...</p>&#10;&#10;<!-- Kode program -->&#10;<pre><code class='language-php'>&#10;  echo 'Hello World';&#10;</code></pre>">{{ old('content') }}</textarea>
                    </div>
                    <p class="text-white/20 text-[11px] mt-2 font-light">Mode Markdown: tulis dengan sintaks MD, otomatis dikonversi. Mode HTML: tulis raw HTML/embed kode langsung.</p>
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
                        @php $oldFaqs = old('faqs', []); @endphp
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
                            <input type="text" name="meta_title" id="meta-title-input" value="{{ old('meta_title') }}" maxlength="255"
                                   class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                                   placeholder="Judul SEO (kosongkan = auto dari judul artikel)">
                        </div>
                        <div>
                            <div class="flex justify-between mb-1.5">
                                <label class="text-white/40 text-xs">Meta Description <span class="text-white/20">(ideal 150-160 karakter)</span></label>
                                <span id="mdesc-counter" class="char-counter text-white/30">0/160</span>
                            </div>
                            <textarea name="meta_description" id="meta-desc-input" rows="2" maxlength="320"
                                      class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all resize-none"
                                      placeholder="Deskripsi untuk Google snippet (kosongkan = auto dari excerpt)...">{{ old('meta_description') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-white/40 text-xs mb-1.5">Keywords <span class="text-white/20">(pisah dengan koma)</span></label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                   class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                                   placeholder="digital marketing, jasa website surabaya, SEO">
                        </div>
                        {{-- OG Image --}}
                        <div class="border-t border-white/5 pt-4">
                            <label class="block text-white/40 text-xs mb-1.5">
                                OG Image <span class="text-white/20">(untuk share WhatsApp, Facebook — ideal 1200×630px)</span>
                            </label>
                            <div class="border-2 border-dashed border-white/10 rounded-xl p-4 text-center hover:border-[#9acb03]/30 transition-colors" id="og-drop-zone">
                                <svg class="w-8 h-8 text-white/20 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-white/30 text-xs mb-2">Klik atau drag gambar ke sini</p>
                                <input type="file" name="og_image" id="og-image-input" accept="image/*"
                                       class="hidden" onchange="previewOgImage(this)">
                                <label for="og-image-input" class="cursor-pointer text-xs px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white/50 transition-all">
                                    Pilih Gambar OG
                                </label>
                            </div>
                            <div id="og-preview" class="mt-3 hidden">
                                <img id="og-preview-img" src="" alt="OG Preview" class="w-full max-w-sm rounded-xl opacity-80">
                                <p class="text-white/30 text-xs mt-1">Preview OG Image (1200×630)</p>
                            </div>
                        </div>
                    </div>
                    {{-- SERP Preview --}}
                    <div class="bg-white/3 rounded-xl p-4 border border-white/5">
                        <p class="text-white/30 text-[10px] uppercase tracking-widest mb-3 font-medium">Google SERP Preview</p>
                        <div class="text-blue-400 text-base font-medium leading-tight mb-1" id="serp-title">Judul Artikel Anda</div>
                        <div class="text-green-500 text-xs mb-1">hvmdigital.id › artikel › <span id="serp-slug">slug-artikel</span></div>
                        <div class="text-gray-300 text-sm font-light leading-relaxed" id="serp-desc">Meta description akan tampil di sini...</div>
                    </div>
                </div>
            </div>

            {{-- ===== SIDEBAR ===== --}}
            <div class="space-y-5">
                {{-- Publish --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 space-y-4">
                    <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase">Publish</h3>
                    <div>
                        <label class="block text-white/40 text-xs mb-1.5">Penulis / Author (Opsional)</label>
                        <input type="text" name="author_name" value="{{ old('author_name', session('admin_name', '')) }}"
                               class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all"
                               placeholder="Nama Penulis">
                    </div>
                    <div>
                        <label class="block text-white/40 text-xs mb-1.5">Status</label>
                        <select name="status" class="w-full bg-white/5 border border-white/10 text-white font-light text-sm px-4 py-3 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                            <option value="draft" {{ old('status')=='draft'?'selected':'' }}>📋 Draft</option>
                            <option value="published" {{ old('status')=='published'?'selected':'' }}>🚀 Published</option>
                        </select>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-medium" style="color:#374151;">Kategori Artikel</label>
                            <button type="button" onclick="suggestCategories()" id="btn-suggest-cat"
                                style="background:#f0fdf4;border:1px solid #9acb03;color:#075749;font-size:11px;font-weight:600;padding:4px 10px;border-radius:6px;cursor:pointer;display:flex;align-items:center;gap:4px;transition:all .2s;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                AI Sarankan
                            </button>
                        </div>
                        <select name="article_category_id" id="category-select" required class="form-select">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $parent)
                            <optgroup label="{{ $parent->name }}">
                                <option value="{{ $parent->id }}" {{ old('article_category_id') == $parent->id ? 'selected' : '' }}>
                                    ★ {{ $parent->name }}
                                </option>
                                @foreach($parent->children as $child)
                                <option value="{{ $child->id }}" {{ old('article_category_id') == $child->id ? 'selected' : '' }}>
                                    — {{ $child->name }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>

                        {{-- Smart Suggestion Box --}}
                        <div id="cat-suggestions" class="hidden mt-3">
                            <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#9ca3af;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                <svg width="11" height="11" fill="none" stroke="#9acb03" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                Saran Kategori Relevan
                            </div>
                            <div id="cat-suggestion-list"></div>
                            <p style="font-size:10px;color:#9ca3af;margin-top:4px;">Klik untuk langsung memilih kategori</p>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('admin.articles.index') }}"
                           class="flex-1 text-center border border-white/10 text-white/50 font-light text-sm px-4 py-3 rounded-xl hover:border-white/20 transition-all">
                            Batal
                        </a>
                        <button type="submit"
                                class="flex-1 text-[#053d33] font-semibold text-sm px-4 py-3 rounded-xl hover:scale-105 transition-all"
                                style="background: linear-gradient(135deg, #9acb03, #b8e832);">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg> Simpan
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

                    <div id="featured-preview" class="hidden">
                        <img id="featured-preview-img" src="" alt="Preview" class="w-full rounded-xl opacity-80 mb-2">
                    </div>
                    <div class="border-2 border-dashed border-white/10 rounded-xl p-4 text-center hover:border-[#9acb03]/30 transition-colors">
                        <input type="file" name="featured_image" id="featured-img-input" accept="image/*"
                               class="hidden" onchange="previewFeaturedImage(this)">
                        <label for="featured-img-input" class="cursor-pointer block">
                            <svg class="w-8 h-8 text-white/20 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-white/30 text-xs">Klik untuk upload gambar utama</span>
                        </label>
                    </div>
                    <p class="text-white/20 text-[11px] font-light">Auto convert ke WebP. Digunakan sebagai thumbnail artikel.</p>
                </div>

                {{-- SEO Checklist --}}
                <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
                    <h3 class="text-white/50 text-xs font-medium tracking-widest uppercase mb-4">SEO Checklist</h3>
                    <ul class="space-y-2 text-xs" id="seo-checklist">
                        <li class="flex gap-2 items-center" id="check-title"><span>⬜</span> <span class="text-white/40">Judul artikel diisi</span></li>
                        <li class="flex gap-2 items-center" id="check-excerpt"><span>⬜</span> <span class="text-white/40">Excerpt / ringkasan diisi</span></li>
                        <li class="flex gap-2 items-center" id="check-meta-title"><span>⬜</span> <span class="text-white/40">Meta title diisi</span></li>
                        <li class="flex gap-2 items-center" id="check-meta-desc"><span>⬜</span> <span class="text-white/40">Meta description diisi</span></li>
                        <li class="flex gap-2 items-center" id="check-keywords"><span>⬜</span> <span class="text-white/40">Keywords diisi</span></li>
                        <li class="flex gap-2 items-center" id="check-image"><span>⬜</span> <span class="text-white/40">Featured image diupload</span></li>
                        <li class="flex gap-2 items-center" id="check-og"><span>⬜</span> <span class="text-white/40">OG image diupload</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
<script src="https://unpkg.com/turndown/dist/turndown.js"></script>
<script>
// ─── EasyMDE Editor ───────────────────────────────────────────────────────────
let easyMDE;
let currentMode = 'markdown';
let turndownService;

function initEditor() {
    turndownService = new TurndownService({ headingStyle: 'atx', codeBlockStyle: 'fenced' });
    easyMDE = new EasyMDE({
        element: document.getElementById('content-md'),
        spellChecker: false,
        autofocus: false,
        placeholder: 'Tulis konten artikel di sini dengan Markdown...\n\n## Judul Section\n\nParagraf konten...\n\n```php\n// Contoh kode\necho "Hello World";\n```',
        toolbar: [
            'bold','italic','heading','|',
            'quote','unordered-list','ordered-list','|',
            'link','image','|',
            'preview','side-by-side','fullscreen','|',
            'guide'
        ],
        minHeight: '400px',
    });

    // Auto-convert raw HTML to clean Markdown if present
    const val = easyMDE.value();
    if (val && (val.includes('<p>') || val.includes('<h1>') || val.includes('<h2>') || val.includes('<article>') || val.includes('<strong>'))) {
        easyMDE.value(turndownService.turndown(val));
    }
}

function switchEditorMode(mode) {
    currentMode = mode;
    const mdWrap   = document.getElementById('md-editor-wrap');
    const htmlWrap = document.getElementById('html-editor-wrap');
    const btnMd    = document.getElementById('btn-md');
    const btnHtml  = document.getElementById('btn-html');

    if (mode === 'markdown') {
        mdWrap.classList.remove('hidden');
        htmlWrap.classList.add('hidden');
        btnMd.className   = 'text-xs px-3 py-1.5 rounded-lg bg-[#9acb03]/20 text-[#9acb03] border border-[#9acb03]/30 font-medium';
        btnHtml.className = 'text-xs px-3 py-1.5 rounded-lg bg-white/5 text-white/40 border border-white/10 font-medium';
        // Sync content from raw textarea to MD editor
        const rawContent = document.getElementById('content-raw').value;
        if (rawContent) {
            easyMDE.value(turndownService.turndown(rawContent));
        }
    } else {
        mdWrap.classList.add('hidden');
        htmlWrap.classList.remove('hidden');
        btnMd.className   = 'text-xs px-3 py-1.5 rounded-lg bg-white/5 text-white/40 border border-white/10 font-medium';
        btnHtml.className = 'text-xs px-3 py-1.5 rounded-lg bg-[#9acb03]/20 text-[#9acb03] border border-[#9acb03]/30 font-medium';
        // Sync from MD editor to raw
        document.getElementById('content-raw').value = easyMDE.options.previewRender(easyMDE.value());
        document.getElementById('content-md').name   = 'content_md_disabled';
        document.getElementById('content-raw').name  = 'content';
    }
}

// Before form submit: sync content from active editor
document.getElementById('article-form').addEventListener('submit', function() {
    if (currentMode === 'markdown') {
        document.getElementById('content-md').name  = 'content';
        document.getElementById('content-raw').name = 'content_raw_disabled';
    }
});

// ─── Character Counters ───────────────────────────────────────────────────────
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

// ─── SERP Preview ─────────────────────────────────────────────────────────────
function updateSerp() {
    const title   = document.getElementById('title-input').value || document.getElementById('meta-title-input').value || 'Judul Artikel Anda';
    const metaT   = document.getElementById('meta-title-input').value || title;
    const desc    = document.getElementById('meta-desc-input').value || document.getElementById('excerpt-input').value || 'Meta description akan tampil di sini...';
    let slug      = document.getElementById('slug-input').value.trim();
    if(!slug) {
        slug = title.toLowerCase().replace(/[^a-z0-9\s]/g,'').replace(/\s+/g,'-').substring(0,60);
    }

    document.getElementById('serp-title').textContent  = metaT.substring(0, 60);
    document.getElementById('serp-desc').textContent   = desc.substring(0, 160);
    document.getElementById('serp-slug').textContent   = slug;
}

// ─── Image Previews ───────────────────────────────────────────────────────────
function previewFeaturedImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('featured-preview-img').src = e.target.result;
            document.getElementById('featured-preview').classList.remove('hidden');
            document.getElementById('check-image').innerHTML = '<svg class="w-5 h-5 text-[#9acb03] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> <span class="text-green-400">Featured image diupload</span>';
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
            document.getElementById('check-og').innerHTML = '<svg class="w-5 h-5 text-[#9acb03] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> <span class="text-green-400">OG image diupload</span>';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ─── SEO Checklist ────────────────────────────────────────────────────────────
function updateChecklist() {
    const checks = {
        'check-title':     !!document.getElementById('title-input').value.trim(),
        'check-excerpt':   !!document.getElementById('excerpt-input').value.trim(),
        'check-meta-title':!!document.getElementById('meta-title-input').value.trim(),
        'check-meta-desc': !!document.getElementById('meta-desc-input').value.trim(),
        'check-keywords':  !!document.querySelector('[name="meta_keywords"]').value.trim(),
    };
    const labels = {
        'check-title':     'Judul artikel diisi',
        'check-excerpt':   'Excerpt / ringkasan diisi',
        'check-meta-title':'Meta title diisi',
        'check-meta-desc': 'Meta description diisi',
        'check-keywords':  'Keywords diisi',
    };
    for (const [id, ok] of Object.entries(checks)) {
        document.getElementById(id).innerHTML = ok
            ? `<svg class="w-5 h-5 text-[#9acb03] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> <span class="text-green-400">${labels[id]}</span>`
            : `<span>⬜</span> <span class="text-white/40">${labels[id]}</span>`;
    }
}

// ─── Init ─────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    initEditor();
    setupCounter('excerpt-input',   'excerpt-counter', 500, 400);
    setupCounter('meta-title-input','mtitle-counter',   60,  50);
    setupCounter('meta-desc-input', 'mdesc-counter',   160, 130);

    ['title-input','slug-input','excerpt-input','meta-title-input','meta-desc-input'].forEach(id => {
        const el = document.getElementById(id);
        if (el) { el.addEventListener('input', () => { updateSerp(); updateChecklist(); }); }
    });
    document.querySelector('[name="meta_keywords"]').addEventListener('input', updateChecklist);
    updateSerp(); updateChecklist();
    initCategoryData();
});

// ─── Smart Category Suggester ────────────────────────────────────────────────
const ALL_CATEGORIES = {!! $catJson !!};

// Flatten all categories to [{id, name, fullname}]
const FLAT_CATS = [];
function initCategoryData() {
    ALL_CATEGORIES.forEach(p => {
        FLAT_CATS.push({ id: p.id, name: p.name, fullname: p.name });
        (p.children||[]).forEach(c => {
            FLAT_CATS.push({ id: c.id, name: c.name, fullname: p.name + ' › ' + c.name });
        });
    });
}

// Stop words Indonesia
const STOP_WORDS = new Set(['dan','yang','untuk','dengan','dari','ini','itu','atau','juga','akan','sudah','bisa','ada','dalam','pada','tidak','lebih','cara','setiap','secara','kita','mari','mereka','apa','bagaimana','kenapa','oleh','saat','jika','agar','kami','anda','kamu','saya','kini','baru','serta','namun','tapi','karena','sebuah','semua','per','bagi','hingga','sejak','antara','tanpa','setelah','sebelum','menjadi','sebagai','sangat','hanya','jadi','satu','dua','tiga','lagi','masih','terus','paling','kali','bulan','tahun','hari','betapa','total','banyak','mari','hitung','jujur','transparan','kembali']);

// Semantic mapping: kata kunci artikel → keywords yang relevan di nama kategori
const SEMANTIC_MAP = {
    // E-Commerce / Marketplace
    'shopee':['brand','fashion','toko','olshop','distributor','konveksi','retail'],
    'tokopedia':['brand','fashion','toko','olshop','distributor'],
    'lazada':['brand','fashion','toko','olshop','distributor'],
    'marketplace':['brand','fashion','toko','olshop','distributor'],
    'seller':['brand','fashion','toko','olshop','distributor','retail'],
    'biaya':['brand','startup','distributor','bisnis'],
    'margin':['brand','startup','distributor','trader'],
    'omzet':['brand','startup','distributor','kuliner'],
    // Digital
    'website':['konsultan','startup','teknologi','media'],
    'seo':['konsultan','startup','teknologi','media'],
    'digital':['konsultan','startup','teknologi','media'],
    'marketing':['konsultan','startup','media','brand'],
    'google':['konsultan','startup','teknologi'],
    'iklan':['konsultan','media','brand'],
    'branding':['brand','fashion','konsultan'],
    'traffic':['konsultan','startup','teknologi'],
    // Fashion
    'fashion':['fashion','brand','konveksi','busana','pakaian'],
    'baju':['fashion','brand','konveksi','pakaian'],
    'gamis':['busana','muslim','fashion'],
    'hijab':['busana','muslim','fashion'],
    'sepatu':['sepatu','aksesori','fashion'],
    // Skincare
    'skincare':['skincare','kecantikan','kosmetik'],
    'kosmetik':['skincare','kecantikan','kosmetik'],
    // Kuliner
    'kuliner':['kuliner','restoran','kafe','katering','bakery'],
    'makanan':['kuliner','restoran','kafe','katering'],
    'minuman':['kuliner','kafe','boba','minuman'],
    'kafe':['kafe','coffee','kuliner'],
    'resto':['restoran','kuliner','kafe'],
    'catering':['katering','kuliner','boga'],
    // Properti
    'properti':['properti','developer','agen','kontraktor'],
    'rumah':['properti','developer','renovasi'],
    'kontraktor':['kontraktor','properti','renovasi'],
    // Kesehatan
    'dokter':['klinik','umum','fisioterapi'],
    'apotek':['apotek','obat','kesehatan'],
    // Pendidikan
    'kursus':['kursus','bimbel','pelatihan'],
    'bimbel':['bimbel','kursus','les'],
    // Otomotif
    'mobil':['bengkel','dealer','rental','modifikasi'],
    'motor':['bengkel','dealer','aksesori'],
    // Startup/Tech
    'startup':['startup','scaleup','teknologi','saas'],
    'teknologi':['teknologi','startup','saas','konsultan'],
    'fintech':['fintech','keuangan','startup'],
};

function tokenize(text) {
    return text.toLowerCase()
        .replace(/[^a-z0-9\s]/g, ' ')
        .split(/\s+/)
        .filter(w => w.length >= 3 && !STOP_WORDS.has(w));
}

function scoreCategory(catFullname, articleTokens) {
    const catLower = catFullname.toLowerCase().replace(/[^a-z0-9\s]/g, ' ');
    const catWords = catLower.split(/\s+/).filter(w => w.length >= 3);
    let score = 0;
    articleTokens.forEach(token => {
        // Exact word match dengan nama kategori — skor tertinggi
        catWords.forEach(cw => {
            if (cw === token) score += 5;
        });
        // Semantic mapping
        const semanticWords = SEMANTIC_MAP[token] || [];
        semanticWords.forEach(sw => {
            if (catLower.includes(sw)) score += 2;
        });
    });
    return score;
}

function suggestCategories() {
    const title   = document.getElementById('title-input').value || '';
    const excerpt = document.getElementById('excerpt-input').value || '';
    const keywords= document.querySelector('[name="meta_keywords"]').value || '';
    const combined = title + ' ' + excerpt + ' ' + keywords;

    if (combined.trim().length < 5) {
        alert('Isi judul atau excerpt terlebih dahulu agar AI bisa menganalisis.');
        return;
    }

    const tokens = tokenize(combined);

    // Score all categories
    const scored = FLAT_CATS.map(cat => ({
        ...cat,
        score: scoreCategory(cat.fullname, tokens)
    })).filter(c => c.score > 0)
       .sort((a,b) => b.score - a.score)
       .slice(0, 4);

    const box  = document.getElementById('cat-suggestions');
    const list = document.getElementById('cat-suggestion-list');

    if (scored.length === 0) {
        list.innerHTML = '<p style="font-size:12px;color:#9ca3af;padding:8px 0;">Tidak ada kategori yang cocok. Coba tambahkan kata kunci di judul atau excerpt.</p>';
        box.classList.remove('hidden');
        return;
    }

    const maxScore = scored[0].score;
    list.innerHTML = scored.map((cat, i) => {
        const pct = Math.round((cat.score / maxScore) * 100);
        const isTop = i === 0;
        return `
        <div class="cat-suggestion-item ${isTop?'top-pick':''}" onclick="selectCategory(${cat.id})">
            <div style="flex:1;min-width:0;">
                ${ isTop ? '<span style="font-size:9px;background:#9acb03;color:#053d33;padding:1px 6px;border-radius:10px;font-weight:700;margin-right:4px;">TOP</span>' : '' }
                <span style="font-size:12px;font-weight:${isTop?'600':'400'};color:#111827;">${cat.fullname}</span>
            </div>
            <div style="display:flex;align-items:center;gap:6px;flex-shrink:0;">
                <span style="font-size:11px;color:#075749;font-weight:600;">${pct}%</span>
                <div class="cat-score-bar"><div class="cat-score-fill" style="width:${pct}%"></div></div>
            </div>
        </div>`;
    }).join('');

    box.classList.remove('hidden');

    // Auto-suggest animation on button
    const btn = document.getElementById('btn-suggest-cat');
    btn.textContent = '✓ Dianalisis!';
    setTimeout(() => { btn.innerHTML = '<svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> AI Sarankan'; }, 1500);
}

function selectCategory(id) {
    const sel = document.getElementById('category-select');
    if (sel) {
        sel.value = id;
        document.getElementById('cat-suggestions').classList.add('hidden');
        // Flash green border
        sel.style.borderColor = '#9acb03';
        sel.style.boxShadow = '0 0 0 3px rgba(154,203,3,0.15)';
        setTimeout(() => { sel.style.borderColor=''; sel.style.boxShadow=''; }, 1500);
    }
}

// FAQ Repeater
let faqIndex = {{ count(old('faqs', [])) }};
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
