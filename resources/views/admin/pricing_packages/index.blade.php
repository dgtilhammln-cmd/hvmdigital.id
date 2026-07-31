@extends('layouts.admin')
@section('title','Paket Harga')
@section('page-title','Kelola Paket Harga')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-white text-lg font-medium">Daftar Paket Harga</h2>
        <p class="text-white/40 text-sm font-light">Kelola pilihan paket yang tampil di website.</p>
    </div>
    <a href="{{ route('admin.pricing_packages.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#9acb03] text-[#053d33] font-semibold text-sm rounded-xl hover:bg-[#b8e832] transition-colors shadow-lg">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Paket
    </a>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-white/70">
            <thead class="text-xs text-white/40 uppercase bg-white/5 border-b border-white/5">
                <tr>
                    <th class="px-6 py-4 font-medium">Urutan</th>
                    <th class="px-6 py-4 font-medium">Nama Paket</th>
                    <th class="px-6 py-4 font-medium">Harga</th>
                    <th class="px-6 py-4 font-medium">Style</th>
                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 font-light">
                @forelse($packages as $p)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-4">{{ $p->order }}</td>
                    <td class="px-6 py-4">
                        <div class="text-white font-medium">{{ $p->name }}</div>
                        @if($p->is_popular)
                        <span class="inline-block mt-1 text-[10px] bg-[#9acb03]/10 text-[#9acb03] px-2 py-0.5 rounded border border-[#9acb03]/20">Paling Populer</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $p->price }}</td>
                    <td class="px-6 py-4 uppercase text-xs">{{ $p->theme_style }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.pricing_packages.edit', $p) }}" class="p-2 text-white/50 hover:text-[#9acb03] hover:bg-[#9acb03]/10 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.pricing_packages.destroy', $p) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus paket ini?');">
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
                    <td colspan="5" class="px-6 py-12 text-center text-white/40">Belum ada paket harga.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
