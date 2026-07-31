@extends('layouts.admin')
@section('title','Testimoni')
@section('page-title','Kelola Testimoni')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-white text-lg font-medium">Daftar Testimoni</h2>
        <p class="text-white/40 text-sm font-light">Kelola ulasan dari klien HVM Digital.</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#9acb03] text-[#053d33] font-semibold text-sm rounded-xl hover:bg-[#b8e832] transition-colors shadow-lg">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Testimoni
    </a>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-white/70">
            <thead class="text-xs text-white/40 uppercase bg-white/5 border-b border-white/5">
                <tr>
                    <th class="px-6 py-4 font-medium">Klien</th>
                    <th class="px-6 py-4 font-medium">Layanan</th>
                    <th class="px-6 py-4 font-medium">Rating</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 font-light">
                @forelse($testimonials as $item)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-4 flex items-center gap-3">
                        @if($item->photo_thumb)
                        <img src="{{ asset($item->photo_thumb) }}" alt="{{ $item->name }}" class="w-10 h-10 rounded-full object-cover border border-white/10">
                        @else
                        <div class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/50 text-xs font-bold uppercase">
                            {{ substr($item->name, 0, 2) }}
                        </div>
                        @endif
                        <div>
                            <div class="text-white font-medium">{{ $item->name }}</div>
                            <div class="text-[11px] text-white/40">{{ $item->company ?: $item->city }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-xs">{{ $item->service_used ?: '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-0.5 text-yellow-500">
                            @for($i=0; $i<$item->rating; $i++)
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-green-500/10 border border-green-500/20 text-green-400 text-xs">Aktif</span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-red-500/10 border border-red-500/20 text-red-400 text-xs">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.testimonials.edit', $item) }}" class="p-2 text-white/50 hover:text-[#9acb03] hover:bg-[#9acb03]/10 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus testimoni ini?');">
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
                    <td colspan="5" class="px-6 py-12 text-center text-white/40">Belum ada testimoni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $testimonials->links() }}
    </div>
    @endif
</div>
@endsection
