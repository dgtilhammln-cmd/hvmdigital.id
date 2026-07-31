@extends('layouts.admin')
@section('title','Kategori Artikel')
@section('page-title','Manajemen Kategori Artikel')
@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-white font-semibold">Kategori Artikel</h2>
        <p class="text-white/30 text-xs font-light mt-1">{{ $categories->count() }} kategori induk · {{ $categories->sum(fn($c) => $c->children->count()) }} sub-kategori</p>
    </div>
    <a href="{{ route('admin.article-categories.create') }}"
       class="inline-flex items-center gap-2 text-[#053d33] font-semibold text-sm px-5 py-2.5 rounded-xl hover:scale-105 transition-all"
       style="background: linear-gradient(135deg, #9acb03, #b8e832);">
        + Tambah Kategori
    </a>
</div>

@if(session('success'))
<div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl px-5 py-3 mb-5 text-sm font-light">
    <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> {{ session('success') }}
</div>
@endif

<div class="space-y-4">
    @forelse($categories as $parent)
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
        {{-- Parent row --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/5">
            <div class="flex items-center gap-4">
                <div class="w-2.5 h-2.5 rounded-full shrink-0" style="background: {{ $parent->color }};"></div>
                <div>
                    <p class="text-white font-semibold text-sm">{{ $parent->name }}</p>
                    <p class="text-white/30 text-xs font-light mt-0.5">/{{ $parent->slug }} · {{ $parent->children->count() }} sub-kategori · {{ $parent->articles_count }} artikel</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2.5 py-1 rounded-full {{ $parent->is_active ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-500' }}">
                    {{ $parent->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
                <a href="{{ route('admin.article-categories.edit', $parent) }}"
                   class="text-xs px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white/50 hover:text-white rounded-lg transition-all">
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.article-categories.destroy', $parent) }}"
                      onsubmit="return confirm('Hapus kategori {{ $parent->name }}? Sub-kategori akan menjadi induk.')">
                    @csrf @method('DELETE')
                    <button class="text-xs px-3 py-1.5 bg-red-500/5 hover:bg-red-500/10 text-red-400/60 hover:text-red-400 rounded-lg transition-all">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        {{-- Children --}}
        @if($parent->children->count())
        <div class="divide-y divide-white/3">
            @foreach($parent->children->sortBy('sort_order') as $child)
            <div class="flex items-center justify-between px-6 py-3 pl-12">
                <div class="flex items-center gap-3">
                    <svg class="w-3 h-3 text-white/20 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h12M3 17h9"/></svg>
                    <div>
                        <p class="text-white/70 text-sm font-light">{{ $child->name }}</p>
                        <p class="text-white/20 text-xs font-light">/{{ $child->slug }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-white/20 text-xs">{{ $child->articles_count ?? 0 }} artikel</span>
                    <a href="{{ route('admin.article-categories.edit', $child) }}"
                       class="text-xs px-3 py-1 bg-white/3 hover:bg-white/8 text-white/40 hover:text-white/70 rounded-lg transition-all">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('admin.article-categories.destroy', $child) }}"
                          onsubmit="return confirm('Hapus sub-kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="text-xs px-3 py-1 bg-red-500/3 hover:bg-red-500/8 text-red-400/40 hover:text-red-400/80 rounded-lg transition-all">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Add child link --}}
        <div class="px-6 py-2.5 bg-white/[0.02]">
            <a href="{{ route('admin.article-categories.create', ['parent_id' => $parent->id]) }}"
               class="text-xs text-[#9acb03]/50 hover:text-[#9acb03] transition-colors flex items-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah sub-kategori ke {{ $parent->name }}
            </a>
        </div>
    </div>
    @empty
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-12 text-center">
        <p class="text-white/30 text-sm font-light mb-4">Belum ada kategori.</p>
        <a href="{{ route('admin.article-categories.create') }}"
           class="text-xs text-[#9acb03] hover:underline">Tambah kategori pertama →</a>
    </div>
    @endforelse
</div>

@endsection
