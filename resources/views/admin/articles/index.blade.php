@extends('layouts.admin')
@section('title','Artikel')
@section('page-title','Manajemen Artikel')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div><h2 class="text-white font-semibold">Artikel / Blog</h2><p class="text-white/30 text-xs font-light mt-1">{{ $articles->total() }} total artikel</p></div>
    <a href="{{ route('admin.articles.create') }}" class="bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold text-sm px-5 py-2.5 rounded-xl hover:scale-105 transition-all flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Tambah Artikel</a>
</div>
<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5">
            <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">Judul</th>
            <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider hidden md:table-cell">Kategori</th>
            <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">Status</th>
            <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider hidden lg:table-cell">Views</th>
            <th class="text-right text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">Aksi</th>
        </tr></thead>
        <tbody class="divide-y divide-white/5">
            @forelse($articles as $article)
            <tr class="hover:bg-white/2 transition-colors">
                <td class="px-6 py-4"><p class="text-white/80 font-light text-sm line-clamp-1">{{ $article->title }}</p><p class="text-white/30 text-xs font-light mt-0.5">{{ $article->published_at?->format('d M Y') ?? 'Draft' }}</p></td>
                <td class="px-6 py-4 hidden md:table-cell"><span class="bg-white/5 text-white/50 text-xs px-3 py-1 rounded-full">{{ $article->category ?? '—' }}</span></td>
                <td class="px-6 py-4"><span class="text-xs px-3 py-1 rounded-full font-medium {{ $article->status==='published'?'bg-green-500/10 text-green-400':'bg-yellow-500/10 text-yellow-400' }}">{{ $article->status==='published'?'Published':'Draft' }}</span></td>
                <td class="px-6 py-4 hidden lg:table-cell text-white/40 text-sm font-light">{{ number_format($article->views) }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="text-[#9acb03]/70 hover:text-[#9acb03] text-xs font-light px-3 py-1.5 bg-[#9acb03]/5 hover:bg-[#9acb03]/10 rounded-lg transition-all flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit</a>
                        <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400/70 hover:text-red-400 text-xs font-light px-3 py-1.5 bg-red-500/5 hover:bg-red-500/10 rounded-lg transition-all flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-white/30 text-sm font-light">Belum ada artikel. <a href="{{ route('admin.articles.create') }}" class="text-[#9acb03] hover:underline">Tambah sekarang →</a></td></tr>
            @endforelse
        </tbody>
    </table>
    @if($articles->hasPages())
    <div class="px-6 py-4 border-t border-white/5">{{ $articles->links() }}</div>
    @endif
</div>
@endsection
