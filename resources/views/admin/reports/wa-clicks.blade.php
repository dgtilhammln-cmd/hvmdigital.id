@extends('layouts.admin')
@section('title','Laporan WA Click')
@section('page-title','Laporan WhatsApp Click')
@push('head')<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>@endpush
@section('content')
<div class="flex items-center gap-4 mb-6">
    @foreach([7,14,30,90] as $d)<a href="?days={{ $d }}" class="text-xs font-light px-4 py-2 rounded-xl border transition-all {{ $days==$d?'bg-green-500/10 border-green-500/30 text-green-400':'border-white/10 text-white/40 hover:border-white/20' }}">{{ $d }} Hari</a>@endforeach
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2 bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
        <h3 class="text-white font-medium text-sm mb-5">Grafik Klik WA</h3>
        <canvas id="waChart" height="120"></canvas>
    </div>
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
        <h3 class="text-white font-medium text-sm mb-5">Klik per Sumber</h3>
        <div class="space-y-3">
            @foreach($bySource as $src)
            <div class="flex items-center justify-between">
                <span class="text-white/50 text-xs font-light capitalize bg-white/5 px-3 py-1 rounded-full">{{ $src->source??'unknown' }}</span>
                <span class="text-green-400 text-sm font-semibold">{{ $src->count }}</span>
            </div>
            @endforeach
        </div>
        <div class="mt-5 pt-5 border-t border-white/5">
            <h4 class="text-white/40 text-xs font-medium mb-3">Top Halaman</h4>
            @foreach($topPages as $p)
            <div class="flex items-center gap-2 mb-2">
                <p class="flex-1 text-white/40 text-xs font-light truncate">{{ parse_url($p->page_url,PHP_URL_PATH)?:'/' }}</p>
                <span class="text-green-400 text-xs font-medium shrink-0">{{ $p->count }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-white/5"><h3 class="text-white font-medium text-sm">Log Klik WA Terbaru</h3></div>
    <table class="w-full text-xs">
        <thead><tr class="border-b border-white/5"><th class="text-left text-white/30 font-medium px-6 py-3 uppercase tracking-wider">Halaman</th><th class="text-left text-white/30 font-medium px-6 py-3 uppercase tracking-wider hidden md:table-cell">Sumber</th><th class="text-left text-white/30 font-medium px-6 py-3 uppercase tracking-wider">Waktu</th></tr></thead>
        <tbody class="divide-y divide-white/5">
            @forelse($clicks as $c)
            <tr class="hover:bg-white/2">
                <td class="px-6 py-3 text-white/60 font-light max-w-xs truncate">{{ parse_url($c->page_url,PHP_URL_PATH)?:'/' }}</td>
                <td class="px-6 py-3 hidden md:table-cell"><span class="bg-green-500/10 text-green-400 px-2 py-0.5 rounded-full capitalize">{{ $c->source??'—' }}</span></td>
                <td class="px-6 py-3 text-white/30">{{ $c->created_at->diffForHumans() }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="px-6 py-8 text-center text-white/30">Belum ada data klik WA</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($clicks->hasPages())<div class="px-6 py-4 border-t border-white/5">{{ $clicks->links() }}</div>@endif
</div>
@endsection
@push('scripts')
<script>
new Chart(document.getElementById('waChart'),{type:'bar',data:{labels:@json($chartLabels),datasets:[{label:'Klik WA',data:@json($chartData),backgroundColor:'rgba(34,197,94,0.2)',borderColor:'#22c55e',borderWidth:2,borderRadius:4}]},options:{responsive:true,plugins:{legend:{display:false}},scales:{x:{grid:{color:'rgba(255,255,255,0.04)'},ticks:{color:'rgba(255,255,255,0.3)',font:{size:10}}},y:{grid:{color:'rgba(255,255,255,0.04)'},ticks:{color:'rgba(255,255,255,0.3)',font:{size:10}},beginAtZero:true}}}});
</script>
@endpush
