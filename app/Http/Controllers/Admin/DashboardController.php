<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\WaClick;
use App\Models\Article;
use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today     = now()->toDateString();
        $thisWeek  = now()->startOfWeek()->toDateString();
        $thisMonth = now()->startOfMonth()->toDateString();

        // Visitor stats
        $visitorsToday = Visitor::whereDate('created_at', $today)->count();
        $visitorsWeek  = Visitor::whereDate('created_at', '>=', $thisWeek)->count();
        $visitorsMonth = Visitor::whereDate('created_at', '>=', $thisMonth)->count();
        $visitorsTotal = Visitor::count();

        // WA click stats
        $waToday = WaClick::whereDate('created_at', $today)->count();
        $waWeek  = WaClick::whereDate('created_at', '>=', $thisWeek)->count();
        $waMonth = WaClick::whereDate('created_at', '>=', $thisMonth)->count();
        $waTotal = WaClick::count();

        // Popular pages (last 30 days)
        $popularPages = Visitor::select('page_url', DB::raw('count(*) as visits'))
            ->whereDate('created_at', '>=', now()->subDays(30)->toDateString())
            ->groupBy('page_url')
            ->orderByDesc('visits')
            ->take(10)
            ->get();

        // Daily visitors chart (last 14 days)
        $dailyVisitors = Visitor::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->whereDate('created_at', '>=', now()->subDays(13)->toDateString())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Build full 14-day labels
        $chartLabels = [];
        $chartData   = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartLabels[] = now()->subDays($i)->format('d M');
            $chartData[]   = $dailyVisitors[$date]->count ?? 0;
        }

        // WA clicks by source
        $waBySource = WaClick::select('source', DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(30)->toDateString())
            ->groupBy('source')
            ->get();

        // Content counts
        $articlesCount  = Article::count();
        $servicesCount  = Service::count();
        $portfolioCount = Portfolio::count();

        return view('admin.dashboard', compact(
            'visitorsToday', 'visitorsWeek', 'visitorsMonth', 'visitorsTotal',
            'waToday', 'waWeek', 'waMonth', 'waTotal',
            'popularPages', 'chartLabels', 'chartData', 'waBySource',
            'articlesCount', 'servicesCount', 'portfolioCount'
        ));
    }
}
