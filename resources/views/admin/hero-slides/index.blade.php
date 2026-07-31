@extends('layouts.admin')
@section('title', 'Hero Slider')
@section('page-title', 'Manajemen Hero Slider')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-white font-semibold">Hero Slider</h2>
        <p class="text-white/30 text-xs font-light mt-1">Atur gambar dan teks di halaman utama</p>
    </div>
    <a href="{{ route('admin.hero-slides.create') }}" class="bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold text-sm px-5 py-2.5 rounded-xl hover:scale-105 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Tambah Slide
    </a>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-white/5">
                <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">Gambar</th>
                <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">Headline</th>
                <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider text-center">Urutan</th>
                <th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider text-center">Status</th>
                <th class="text-right text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($slides as $slide)
            <tr class="hover:bg-white/2 transition-colors">
                <td class="px-6 py-4">
                    <img src="{{ get_image_url($slide->image) }}" alt="Slide" class="h-12 w-20 object-cover rounded bg-white/5">
                </td>
                <td class="px-6 py-4">
                    <p class="text-white/80 font-light text-sm line-clamp-1">{{ $slide->headline }}</p>
                    <p class="text-white/30 text-xs font-light mt-0.5 line-clamp-1">{{ $slide->subheadline ?? '-' }}</p>
                </td>
                <td class="px-6 py-4 text-center text-white/60">
                    {{ $slide->order }}
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="text-xs px-3 py-1 rounded-full font-medium {{ $slide->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                        {{ $slide->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="text-white/30 hover:text-white transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline" onsubmit="return confirm('Hapus slide ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400/50 hover:text-red-400 transition-colors" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-white/30 font-light text-sm">Belum ada slide.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
