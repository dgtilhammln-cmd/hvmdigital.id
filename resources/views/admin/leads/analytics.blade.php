@extends('layouts.admin')
@section('title', 'CRM Analytics')
@section('page-title', 'CRM Analytics')
@section('page-subtitle', 'Dashboard statistik dan performa leads HVM Digital.')

@section('content')

{{-- KPI Cards --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(155px,1fr));gap:16px;margin-bottom:28px;">
    @php
    $kpis = [
        [
            'label' => 'Total Leads',
            'value' => $total,
            'sub'   => 'Semua waktu',
            'color' => '#6366f1',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
        ],
        [
            'label' => 'Won / Closing',
            'value' => $won,
            'sub'   => 'Berhasil closing',
            'color' => '#10b981',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        ],
        [
            'label' => 'Lost',
            'value' => $lost,
            'sub'   => 'Tidak jadi',
            'color' => '#ef4444',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        ],
        [
            'label' => 'Conversion Rate',
            'value' => $convRate . '%',
            'sub'   => 'Won / Total',
            'color' => '#f59e0b',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>',
        ],
        [
            'label' => 'Overdue Follow-up',
            'value' => $overdue,
            'sub'   => 'Perlu dicontact',
            'color' => '#f43f5e',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        ],
    ];
    @endphp
    @foreach($kpis as $k)
    <div style="background:#fff;border-radius:16px;padding:20px;border:1px solid #f3f4f6;box-shadow:0 2px 8px rgba(0,0,0,.05);border-top:4px solid {{ $k['color'] }};">
        <div style="color:{{ $k['color'] }};margin-bottom:8px;">{!! $k['icon'] !!}</div>
        <div style="font-size:28px;font-weight:800;color:{{ $k['color'] }};line-height:1;margin-bottom:4px;">{{ $k['value'] }}</div>
        <div style="font-size:13px;font-weight:600;color:#374151;">{{ $k['label'] }}</div>
        <div style="font-size:11px;color:#9ca3af;margin-top:2px;">{{ $k['sub'] }}</div>
    </div>
    @endforeach
</div>

{{-- Charts Row --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:16px;">

    {{-- Line Chart: Leads per Bulan --}}
    <div class="panel" style="padding:24px;">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <h3 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Leads per Bulan (12 Bulan Terakhir)</h3>
        </div>
        <canvas id="monthlyChart" style="max-height:250px;"></canvas>
    </div>

    {{-- Doughnut Chart: Status --}}
    <div class="panel" style="padding:24px;">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
            <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
            <h3 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Distribusi Status</h3>
        </div>
        <canvas id="statusChart" style="max-height:250px;"></canvas>
    </div>
</div>

{{-- Bar Chart: Source --}}
<div class="panel" style="padding:24px;margin-bottom:16px;">
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
        <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        <h3 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Leads per Sumber Halaman</h3>
    </div>
    <canvas id="sourceChart" style="max-height:200px;"></canvas>
</div>

{{-- Back --}}
<div style="margin-top:4px;">
    <a href="{{ route('admin.leads.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#6366f1;font-size:13px;text-decoration:none;font-weight:500;">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Leads
    </a>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const monthlyLabels = @json($monthly->pluck('month'));
const monthlyData   = @json($monthly->pluck('total'));

const statusLabels  = @json($byStatus->pluck('status')->map(fn($s) => \App\Models\Lead::$statusLabels[$s] ?? $s));
const statusData    = @json($byStatus->pluck('total'));
const statusBg      = @json($byStatus->pluck('status')->map(fn($s) => \App\Models\Lead::$statusColors[$s] ?? '#6b7280'));

const sourceLabels  = @json($bySources->pluck('source_group'));
const sourceData    = @json($bySources->pluck('total'));

Chart.defaults.font.family = 'Inter, system-ui, sans-serif';

// Monthly
new Chart(document.getElementById('monthlyChart'), {
    type: 'line',
    data: {
        labels: monthlyLabels,
        datasets: [{
            label: 'Leads',
            data: monthlyData,
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99,102,241,.08)',
            fill: true,
            tension: 0.45,
            pointBackgroundColor: '#6366f1',
            pointRadius: 5,
            pointHoverRadius: 7,
            borderWidth: 2.5,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1, color: '#9ca3af', font: { size: 11 } }, grid: { color: '#f3f4f6' } },
            x: { ticks: { color: '#9ca3af', font: { size: 11 } }, grid: { display: false } }
        }
    }
});

// Status doughnut
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: statusLabels,
        datasets: [{ data: statusData, backgroundColor: statusBg, borderWidth: 3, borderColor: '#fff', hoverOffset: 6 }]
    },
    options: {
        responsive: true,
        cutout: '62%',
        plugins: {
            legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 12, usePointStyle: true } }
        }
    }
});

// Source bar
new Chart(document.getElementById('sourceChart'), {
    type: 'bar',
    data: {
        labels: sourceLabels,
        datasets: [{
            label: 'Leads',
            data: sourceData,
            backgroundColor: ['#6366f1','#10b981','#f59e0b','#3b82f6','#8b5cf6','#ef4444'],
            borderRadius: 8,
            borderSkipped: false,
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1, color: '#9ca3af', font: { size: 11 } }, grid: { color: '#f3f4f6' } },
            x: { ticks: { color: '#9ca3af', font: { size: 11 } }, grid: { display: false } }
        }
    }
});
</script>
@endsection
