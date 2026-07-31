@extends('layouts.admin')
@section('title','Popular Pages')
@section('page-title','Halaman Terpopuler')
@section('content')
<div class="flex items-center gap-4 mb-6">
    @foreach([7,14,30,90] as $d)<a href="?days={{ $d }}" class="text-xs font-light px-4 py-2 rounded-xl border transition-all {{ $days==$d?'bg-[#9acb03]/10 border-[#9acb03]/30 text-[#9acb03]':'border-white/10 text-white/40 hover:border-white/20' }}">{{ $d }} Hari</a>@endforeach
</div>
<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5"><th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">URL Halaman</th><th class="text-left text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider hidden md:table-cell">Judul</th><th class="text-right text-white/30 font-medium text-xs px-6 py-4 uppercase tracking-wider">Kunjungan</th></tr></thead>
        <tbody class="divide-y divide-white/5">
            @forelse($pages as $i => $p)
            <tr class="hover:bg-white/2">
                <td class="px-6 py-4"><p class="text-white/70 font-light text-xs">{{ parse_url($p->page_url,PHP_URL_PATH)?:'/' }}</p></td>
                <td class="px-6 py-4 hidden md:table-cell text-white/40 text-xs font-light">{{ $p->page_title??'—' }}</td>
                <td class="px-6 py-4 text-right"><span class="text-[#9acb03] font-semibold">{{ number_format($p->visits) }}</span></td>
            </tr>
            @empty
            <tr><td colspan="3" class="px-6 py-8 text-center text-white/30 text-sm">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($pages->hasPages())<div class="px-6 py-4 border-t border-white/5">{{ $pages->links() }}</div>@endif
</div>
@endsection
