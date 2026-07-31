@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview performa website & konten HVM Digital')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')

{{-- Top 4 Stats --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:20px;">

    {{-- Visitor Hari Ini --}}
    <div class="stat-card">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;">
            <div style="background:#f0fdf4;width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#15803d" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <span style="font-size:10px;font-weight:600;color:#9ca3af;background:#f9fafb;padding:3px 8px;border-radius:20px;">Hari Ini</span>
        </div>
        <div style="font-size:28px;font-weight:800;color:#111827;line-height:1;">{{ number_format($visitorsToday) }}</div>
        <div style="font-size:12px;color:#6b7280;margin-top:4px;">Visitor Hari Ini</div>
        <div style="font-size:11px;color:#9ca3af;margin-top:6px;padding-top:8px;border-top:1px solid #f3f4f6;">
            Bulan: <span style="color:#075749;font-weight:600;">{{ number_format($visitorsMonth) }}</span>
        </div>
    </div>

    {{-- Total Visitor --}}
    <div class="stat-card">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;">
            <div style="background:#eff6ff;width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#2563eb" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <span style="font-size:10px;font-weight:600;color:#9ca3af;background:#f9fafb;padding:3px 8px;border-radius:20px;">All Time</span>
        </div>
        <div style="font-size:28px;font-weight:800;color:#111827;line-height:1;">{{ number_format($visitorsTotal) }}</div>
        <div style="font-size:12px;color:#6b7280;margin-top:4px;">Total Visitor</div>
        <div style="font-size:11px;color:#9ca3af;margin-top:6px;padding-top:8px;border-top:1px solid #f3f4f6;">
            Minggu: <span style="color:#2563eb;font-weight:600;">{{ number_format($visitorsWeek) }}</span>
        </div>
    </div>

    {{-- WA Klik Hari Ini --}}
    <div class="stat-card">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;">
            <div style="background:#f0fdf4;width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#15803d" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <span style="font-size:10px;font-weight:600;background:#dcfce7;color:#15803d;padding:3px 8px;border-radius:20px;">WhatsApp</span>
        </div>
        <div style="font-size:28px;font-weight:800;color:#111827;line-height:1;">{{ number_format($waToday) }}</div>
        <div style="font-size:12px;color:#6b7280;margin-top:4px;">WA Klik Hari Ini</div>
        <div style="font-size:11px;color:#9ca3af;margin-top:6px;padding-top:8px;border-top:1px solid #f3f4f6;">
            Bulan: <span style="color:#15803d;font-weight:600;">{{ number_format($waMonth) }}</span>
        </div>
    </div>

    {{-- Total WA --}}
    <div class="stat-card">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;">
            <div style="background:#fff7ed;width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="#ea580c" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <span style="font-size:10px;font-weight:600;color:#9ca3af;background:#f9fafb;padding:3px 8px;border-radius:20px;">All Time</span>
        </div>
        <div style="font-size:28px;font-weight:800;color:#111827;line-height:1;">{{ number_format($waTotal) }}</div>
        <div style="font-size:12px;color:#6b7280;margin-top:4px;">Total WA Klik</div>
        <div style="font-size:11px;color:#9ca3af;margin-top:6px;padding-top:8px;border-top:1px solid #f3f4f6;">
            Minggu: <span style="color:#ea580c;font-weight:600;">{{ number_format($waWeek) }}</span>
        </div>
    </div>
</div>

{{-- Content Counters --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px;">
    @foreach([
        ['Artikel', 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', $articlesCount, 'admin.articles.index', '#eff6ff', '#2563eb'],
        ['Layanan', 'M13 10V3L4 14h7v7l9-11h-7z', $servicesCount, 'admin.services.index', '#f0fdf4', '#15803d'],
        ['Portfolio', 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', $portfolioCount, 'admin.portfolios.index', '#fdf4ff', '#9333ea'],
    ] as [$label, $icon, $count, $route, $bg, $color])
    <a href="{{ route($route) }}" style="text-decoration:none;" class="stat-card" style="display:block;">
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="font-size:26px;font-weight:800;color:#111827;">{{ $count }}</div>
                <div style="font-size:12px;color:#6b7280;margin-top:2px;">{{ $label }}</div>
            </div>
            <div style="width:44px;height:44px;background:{{ $bg }};border-radius:12px;display:flex;align-items:center;justify-content:center;">
                <svg width="20" height="20" fill="none" stroke="{{ $color }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}"/></svg>
            </div>
        </div>
        <div style="margin-top:12px;font-size:11px;color:{{ $color }};font-weight:500;">Kelola {{ $label }} →</div>
    </a>
    @endforeach
</div>

{{-- Chart + Pages --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:20px;">

    {{-- Visitor Chart --}}
    <div class="panel">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <div>
                <h2 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Grafik Visitor 14 Hari</h2>
                <p style="font-size:11px;color:#9ca3af;margin:4px 0 0;">Jumlah kunjungan unik harian</p>
            </div>
            <a href="{{ route('admin.analytics.index') }}" style="font-size:12px;color:#075749;font-weight:500;text-decoration:none;background:#f0fdf4;padding:6px 12px;border-radius:8px;border:1px solid #bbf7d0;">Lihat Detail →</a>
        </div>
        <canvas id="visitorChart" height="110"></canvas>
    </div>

    {{-- Popular Pages --}}
    <div class="panel">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h2 style="font-size:14px;font-weight:700;color:#111827;margin:0;">Halaman Terpopuler</h2>
            <a href="{{ route('admin.analytics.index') }}" style="font-size:11px;color:#075749;text-decoration:none;font-weight:500;">Semua →</a>
        </div>
        <div style="display:flex;flex-direction:column;gap:8px;">
            @forelse($popularPages->take(8) as $i => $page)
            <div style="display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:8px;background:#f9fafb;">
                <div style="width:22px;height:22px;border-radius:6px;background:{{ $i === 0 ? '#9acb03' : ($i === 1 ? '#075749' : '#e5e7eb') }};display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:{{ $i < 2 ? '#fff' : '#6b7280' }};flex-shrink:0;">{{ $i+1 }}</div>
                <div style="flex:1;min-width:0;">
                    <p style="font-size:11px;color:#374151;font-weight:500;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $page->page_url }}">
                        {{ parse_url($page->page_url, PHP_URL_PATH) ?: '/' }}
                    </p>
                </div>
                <span style="font-size:12px;font-weight:700;color:#075749;flex-shrink:0;">{{ number_format($page->visits) }}</span>
            </div>
            @empty
            <div style="text-align:center;padding:20px 0;color:#9ca3af;font-size:12px;">Belum ada data halaman</div>
            @endforelse
        </div>
    </div>
</div>

{{-- WA by Source --}}
<div class="panel">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
        <div>
            <h2 style="font-size:14px;font-weight:700;color:#111827;margin:0;">WhatsApp Klik per Sumber</h2>
            <p style="font-size:11px;color:#9ca3af;margin:4px 0 0;">30 hari terakhir</p>
        </div>
        <a href="{{ route('admin.analytics.index') }}" style="font-size:12px;color:#075749;font-weight:500;text-decoration:none;background:#f0fdf4;padding:6px 12px;border-radius:8px;border:1px solid #bbf7d0;">Detail Analytics →</a>
    </div>
    @if($waBySource->count())
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;">
        @foreach($waBySource as $src)
        <div style="background:#f9fafb;border:1px solid #f0f0f0;border-radius:12px;padding:16px;text-align:center;">
            <div style="font-size:24px;font-weight:800;color:#075749;">{{ $src->count }}</div>
            <div style="font-size:11px;color:#6b7280;margin-top:4px;text-transform:capitalize;font-weight:500;">{{ $src->source ?? 'unknown' }}</div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align:center;padding:32px 0;color:#9ca3af;font-size:13px;">
        <svg width="32" height="32" fill="none" stroke="#d1d5db" viewBox="0 0 24 24" style="margin:0 auto 8px;display:block;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Belum ada data klik WhatsApp
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
const ctx = document.getElementById('visitorChart');
if (ctx) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Visitor',
                data: @json($chartData),
                backgroundColor: function(context) {
                    const chart = context.chart;
                    const {ctx: c, chartArea} = chart;
                    if (!chartArea) return 'rgba(154,203,3,0.7)';
                    const gradient = c.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                    gradient.addColorStop(0, 'rgba(154,203,3,0.85)');
                    gradient.addColorStop(1, 'rgba(7,87,73,0.3)');
                    return gradient;
                },
                borderColor: '#9acb03',
                borderWidth: 0,
                borderRadius: 6,
                borderSkipped: false,
            }, {
                label: 'Visitor (line)',
                data: @json($chartData),
                type: 'line',
                borderColor: '#075749',
                backgroundColor: 'transparent',
                borderWidth: 2,
                tension: 0.4,
                pointBackgroundColor: '#075749',
                pointRadius: 3,
                pointHoverRadius: 5,
            }]
        },
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#111827',
                    bodyColor: '#374151',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 10,
                    titleFont: { family: 'Inter', weight: '600', size: 12 },
                    bodyFont: { family: 'Inter', size: 12 },
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#9ca3af', font: { size: 11, family: 'Inter' } },
                    border: { display: false }
                },
                y: {
                    grid: { color: '#f3f4f6' },
                    ticks: { color: '#9ca3af', font: { size: 11, family: 'Inter' } },
                    border: { display: false },
                    beginAtZero: true
                }
            }
        }
    });
}
</script>
@endpush
