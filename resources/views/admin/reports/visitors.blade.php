@extends('layouts.admin')
@section('title','Laporan Visitor')
@section('page-title','Laporan Visitor')
@push('head')<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>@endpush
@section('content')
<div class="flex items-center gap-4 mb-6">
    @foreach([7,14,30,90] as $d)
    <a href="?days={{ $d }}" class="text-xs font-light px-4 py-2 rounded-xl border transition-all {{ $days==$d?'bg-[#9acb03]/10 border-[#9acb03]/30 text-[#9acb03]':'border-white/10 text-white/40 hover:border-white/20' }}">{{ $d }} Hari</a>
    @endforeach
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    @foreach([['<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>','Total Visitor','text-[#9acb03]',collect($chartData)->sum()],['<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>','Mobile','text-blue-400',$devices->where('device_type','mobile')->first()?->count??0],['🖥️','Desktop','text-purple-400',$devices->where('device_type','desktop')->first()?->count??0]] as [$icon,$label,$color,$val])
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5">
        <div class="text-2xl mb-3">{{ $icon }}</div>
        <div class="text-2xl font-bold {{ $color }} mb-1">{{ number_format($val) }}</div>
        <div class="text-white/40 text-xs font-light">{{ $label }} ({{ $days }} hari)</div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2 bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
        <h3 class="text-white font-medium text-sm mb-5">Grafik Visitor</h3>
        <canvas id="visitorChart" height="120"></canvas>
    </div>
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
        <h3 class="text-white font-medium text-sm mb-5">Top Halaman</h3>
        <div class="space-y-3">
            @foreach($topPages as $p)
            <div class="flex items-center gap-3">
                <div class="flex-1 min-w-0"><p class="text-white/60 text-xs font-light truncate">{{ parse_url($p->page_url,PHP_URL_PATH)?:'/' }}</p></div>
                <span class="text-[#9acb03] text-xs font-medium shrink-0">{{ number_format($p->visits) }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-[#0d1f15] border border-white/5 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-white/5"><h3 class="text-white font-medium text-sm">Log Visitor Terbaru</h3></div>
    <div class="overflow-x-auto">
        <table class="w-full text-xs">
            <thead><tr class="border-b border-white/5"><th class="text-left text-white/30 font-medium px-6 py-3 uppercase tracking-wider">Halaman</th><th class="text-left text-white/30 font-medium px-6 py-3 uppercase tracking-wider hidden md:table-cell">Device</th><th class="text-left text-white/30 font-medium px-6 py-3 uppercase tracking-wider hidden lg:table-cell">IP</th><th class="text-left text-white/30 font-medium px-6 py-3 uppercase tracking-wider">Waktu</th></tr></thead>
            <tbody class="divide-y divide-white/5">
                @forelse($visitors as $v)
                <tr class="hover:bg-white/2">
                    <td class="px-6 py-3 text-white/60 font-light max-w-xs truncate">{{ parse_url($v->page_url,PHP_URL_PATH)?:'/' }}</td>
                    <td class="px-6 py-3 hidden md:table-cell"><span class="bg-white/5 text-white/40 px-2 py-0.5 rounded-full capitalize">{{ $v->device_type??'—' }}</span></td>
                    <td class="px-6 py-3 hidden lg:table-cell text-white/30">{{ $v->ip_address??'—' }}</td>
                    <td class="px-6 py-3 text-white/30">{{ $v->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-white/30">Belum ada data visitor</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($visitors->hasPages())<div class="px-6 py-4 border-t border-white/5">{{ $visitors->links() }}</div>@endif
</div>
@endsection
@push('scripts')
<script>
new Chart(document.getElementById('visitorChart'),{type:'line',data:{labels:@json($chartLabels),datasets:[{label:'Visitor',data:@json($chartData),borderColor:'#00d4ff',backgroundColor:'rgba(0,212,255,0.08)',borderWidth:2,fill:true,tension:0.4,pointBackgroundColor:'#00d4ff',pointRadius:3}]},options:{responsive:true,plugins:{legend:{display:false}},scales:{x:{grid:{color:'rgba(255,255,255,0.04)'},ticks:{color:'rgba(255,255,255,0.3)',font:{size:10}}},y:{grid:{color:'rgba(255,255,255,0.04)'},ticks:{color:'rgba(255,255,255,0.3)',font:{size:10}},beginAtZero:true}}}});
</script>
@endpush
