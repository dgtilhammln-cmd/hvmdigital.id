<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\WaClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function visitors(Request $request)
    {
        $days = (int) $request->get('days', 30);

        $visitors = Visitor::whereDate('created_at', '>=', now()->subDays($days)->toDateString())
            ->latest()
            ->paginate(30);

        // Chart data
        $dailyData = Visitor::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->whereDate('created_at', '>=', now()->subDays($days - 1)->toDateString())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $chartLabels = [];
        $chartData   = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date          = now()->subDays($i)->toDateString();
            $chartLabels[] = now()->subDays($i)->format('d M');
            $chartData[]   = $dailyData[$date]->count ?? 0;
        }

        // Device breakdown
        $devices = Visitor::select('device_type', DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays($days)->toDateString())
            ->groupBy('device_type')
            ->get();

        // Top pages
        $topPages = Visitor::select('page_url', DB::raw('count(*) as visits'))
            ->whereDate('created_at', '>=', now()->subDays($days)->toDateString())
            ->groupBy('page_url')
            ->orderByDesc('visits')
            ->take(15)
            ->get();

        return view('admin.reports.visitors', compact(
            'visitors', 'chartLabels', 'chartData', 'devices', 'topPages', 'days'
        ));
    }

    public function waClicks(Request $request)
    {
        $days = (int) $request->get('days', 30);

        $clicks = WaClick::whereDate('created_at', '>=', now()->subDays($days)->toDateString())
            ->latest()
            ->paginate(30);

        // Daily chart
        $dailyData = WaClick::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->whereDate('created_at', '>=', now()->subDays($days - 1)->toDateString())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $chartLabels = [];
        $chartData   = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date          = now()->subDays($i)->toDateString();
            $chartLabels[] = now()->subDays($i)->format('d M');
            $chartData[]   = $dailyData[$date]->count ?? 0;
        }

        // By source
        $bySource = WaClick::select('source', DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays($days)->toDateString())
            ->groupBy('source')
            ->orderByDesc('count')
            ->get();

        // Top pages with WA clicks
        $topPages = WaClick::select('page_url', DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays($days)->toDateString())
            ->groupBy('page_url')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        return view('admin.reports.wa-clicks', compact(
            'clicks', 'chartLabels', 'chartData', 'bySource', 'topPages', 'days'
        ));
    }

    public function popularPages(Request $request)
    {
        $days = (int) $request->get('days', 30);

        $pages = Visitor::select('page_url', 'page_title', DB::raw('count(*) as visits'))
            ->whereDate('created_at', '>=', now()->subDays($days)->toDateString())
            ->groupBy('page_url', 'page_title')
            ->orderByDesc('visits')
            ->paginate(20);

        return view('admin.reports.popular-pages', compact('pages', 'days'));
    }
}
