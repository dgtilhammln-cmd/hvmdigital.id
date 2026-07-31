@extends('layouts.admin')
@section('title', 'Analytics')
@section('page-title', 'Dashboard Analytics')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')

{{-- Top Bar: Filter --}}
<div class="flex justify-between items-center mb-6 bg-[#0d1f15] border border-white/5 rounded-2xl p-4">
    <div>
        <h2 class="text-white font-medium">Performa Situs</h2>
        <p class="text-white/40 text-xs font-light">Ringkasan lalu lintas dan interaksi</p>
    </div>
    <div>
        <form method="GET" action="{{ route('admin.analytics.index') }}" class="flex items-center gap-2">
            <label class="text-white/50 text-xs font-light">Periode:</label>
            <select name="period" onchange="this.form.submit()" class="bg-[#0a1f12] border border-white/10 text-white font-light text-sm px-4 py-2 rounded-xl focus:outline-none focus:border-[#9acb03]/50 transition-all">
                <option value="today" {{ $period == 'today' ? 'selected' : '' }}>Hari Ini</option>
                <option value="7_days" {{ $period == '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                <option value="30_days" {{ $period == '30_days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                <option value="this_year" {{ $period == 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
                <option value="all_time" {{ $period == 'all_time' ? 'selected' : '' }}>Semua Waktu</option>
            </select>
        </form>
    </div>
</div>

{{-- KPI Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    {{-- Total Visitors --}}
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-[#9acb03]/30 transition-all relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-blue-500/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex items-start justify-between mb-4 relative z-10">
            <span class="p-2 bg-blue-500/10 rounded-xl text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </span>
        </div>
        <div class="text-3xl font-bold text-white mb-1 relative z-10">{{ number_format($totalVisitors) }}</div>
        <div class="text-white/40 text-xs font-light relative z-10">Total Kunjungan</div>
    </div>

    {{-- Unique Visitors --}}
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-[#9acb03]/30 transition-all relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-purple-500/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex items-start justify-between mb-4 relative z-10">
            <span class="p-2 bg-purple-500/10 rounded-xl text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </span>
        </div>
        <div class="text-3xl font-bold text-white mb-1 relative z-10">{{ number_format($uniqueVisitors) }}</div>
        <div class="text-white/40 text-xs font-light relative z-10">Pengunjung Unik (IP)</div>
    </div>

    {{-- WA Clicks --}}
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-[#9acb03]/30 transition-all relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-[#9acb03]/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex items-start justify-between mb-4 relative z-10">
            <span class="p-2 bg-[#9acb03]/10 rounded-xl text-[#9acb03]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </span>
        </div>
        <div class="text-3xl font-bold text-[#9acb03] mb-1 relative z-10">{{ number_format($totalWaClicks) }}</div>
        <div class="text-white/40 text-xs font-light relative z-10">Total Klik WA</div>
    </div>

    {{-- Conversion Rate --}}
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-5 hover:border-[#9acb03]/30 transition-all relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-orange-500/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex items-start justify-between mb-4 relative z-10">
            <span class="p-2 bg-orange-500/10 rounded-xl text-orange-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </span>
        </div>
        <div class="text-3xl font-bold text-orange-400 mb-1 relative z-10">{{ $conversionRate }}%</div>
        <div class="text-white/40 text-xs font-light relative z-10">Conversion Rate (Klik WA)</div>
    </div>
</div>

{{-- Chart Section --}}
<div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6 mb-6">
    <div class="mb-4">
        <h3 class="text-white font-medium">Tren Interaksi</h3>
        <p class="text-white/40 text-xs font-light">Perbandingan Kunjungan vs Klik WA berdasarkan periode waktu.</p>
    </div>
    <div class="relative h-80 w-full">
        <canvas id="analyticsChart"></canvas>
    </div>
</div>

{{-- Tables Section --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    
    {{-- Popular Pages --}}
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
        <h3 class="text-white font-medium mb-4">Halaman Terpopuler</h3>
        @if($popularPages->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 text-white/40 text-[10px] uppercase tracking-wider">
                        <th class="py-3 font-medium">Halaman / URL</th>
                        <th class="py-3 font-medium text-center">Views</th>
                        <th class="py-3 font-medium text-center">Unik</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light">
                    @foreach($popularPages as $page)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-3 pr-4">
                            <div class="text-white truncate max-w-[200px] xl:max-w-[300px]" title="{{ $page['title'] ?: $page['url'] }}">{{ $page['title'] ?: $page['url'] }}</div>
                            <div class="text-white/30 text-xs truncate max-w-[200px] xl:max-w-[300px]">{{ $page['url'] }}</div>
                        </td>
                        <td class="py-3 text-center text-white/70">{{ number_format($page['views']) }}</td>
                        <td class="py-3 text-center text-white/70">{{ number_format($page['unique_views']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-white/30 text-sm font-light text-center py-10">Belum ada data kunjungan di periode ini.</div>
        @endif
    </div>

    {{-- WA Sources --}}
    <div class="bg-[#0d1f15] border border-white/5 rounded-2xl p-6">
        <h3 class="text-white font-medium mb-4">Sumber Klik WA Terbanyak</h3>
        @if($waSources->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 text-white/40 text-[10px] uppercase tracking-wider">
                        <th class="py-3 font-medium">Tombol / Sumber Klik</th>
                        <th class="py-3 font-medium text-center">Total Klik</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light">
                    @foreach($waSources as $source)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-3 pr-4">
                            <div class="text-[#9acb03] font-medium capitalize">{{ str_replace('-', ' ', $source['source']) }}</div>
                            <div class="text-white/40 text-xs truncate max-w-[200px] xl:max-w-[300px]" title="{{ $source['title'] ?: $source['url'] }}">{{ $source['title'] ?: $source['url'] }}</div>
                        </td>
                        <td class="py-3 text-center text-white font-medium">{{ number_format($source['clicks']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-white/30 text-sm font-light text-center py-10">Belum ada data klik WA di periode ini.</div>
        @endif
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('analyticsChart').getContext('2d');
    
    // Gradient for Visitors
    const visitorGradient = ctx.createLinearGradient(0, 0, 0, 400);
    visitorGradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)'); // Blue
    visitorGradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

    // Gradient for WA
    const waGradient = ctx.createLinearGradient(0, 0, 0, 400);
    waGradient.addColorStop(0, 'rgba(154, 203, 3, 0.5)'); // Lime
    waGradient.addColorStop(1, 'rgba(154, 203, 3, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartDates) !!},
            datasets: [
                {
                    label: 'Total Kunjungan',
                    data: {!! json_encode($visitorChartData) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: visitorGradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#0d1f15',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Klik WhatsApp',
                    data: {!! json_encode($waChartData) !!},
                    borderColor: '#9acb03',
                    backgroundColor: waGradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#0d1f15',
                    pointBorderColor: '#9acb03',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        color: 'rgba(255, 255, 255, 0.6)',
                        font: { family: "'Montserrat', sans-serif", size: 12 },
                        usePointStyle: true,
                        boxWidth: 8
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(13, 31, 21, 0.9)',
                    titleColor: '#fff',
                    bodyColor: 'rgba(255, 255, 255, 0.7)',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    boxPadding: 4,
                    usePointStyle: true,
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false,
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.4)',
                        font: { family: "'Montserrat', sans-serif", size: 11 }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false,
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.4)',
                        font: { family: "'Montserrat', sans-serif", size: 11 },
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
