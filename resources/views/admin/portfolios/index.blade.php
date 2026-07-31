@extends('layouts.admin')
@section('title','Portfolio')
@section('page-title','Kelola Portfolio')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-white text-lg font-medium">Daftar Portfolio</h2>
        <p class="text-white/40 text-sm font-light">Kelola data portfolio / karya terbaru Anda.</p>
    </div>
    <a href="{{ route('admin.portfolios.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#9acb03] text-[#053d33] font-semibold text-sm rounded-xl hover:bg-[#b8e832] transition-colors shadow-lg">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Portfolio
    </a>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-white/70">
            <thead class="text-xs text-white/40 uppercase bg-white/5 border-b border-white/5">
                <tr>
                    <th class="px-6 py-4 font-medium">Gambar</th>
                    <th class="px-6 py-4 font-medium">Judul</th>
                    <th class="px-6 py-4 font-medium">Kategori</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 font-light">
                @forelse($portfolios as $item)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-4">
                        @if($item->featured_image_thumb)
                        <img src="{{ asset($item->featured_image_thumb) }}" alt="{{ $item->title }}" class="w-16 h-12 object-cover rounded-lg">
                        @else
                        <div class="w-16 h-12 bg-white/5 rounded-lg flex items-center justify-center text-white/30 text-[10px]">No Img</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-white font-medium">{{ $item->title }}</div>
                        <div class="text-[11px] text-white/40 mt-0.5">{{ $item->client }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $item->category ?: '-' }}</td>
                    <td class="px-6 py-4">
                        @if($item->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-green-500/10 border border-green-500/20 text-green-400 text-xs">Aktif</span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-red-500/10 border border-red-500/20 text-red-400 text-xs">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.portfolios.edit', $item) }}" class="p-2 text-white/50 hover:text-[#9acb03] hover:bg-[#9acb03]/10 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus portfolio ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-white/50 hover:text-red-400 hover:bg-red-400/10 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-white/40">Belum ada portfolio.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($portfolios->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $portfolios->links() }}
    </div>
    @endif
</div>
@endsection
