<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\WaClick;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', '7_days');

        $startDate = match ($period) {
            'today' => Carbon::today(),
            '30_days' => Carbon::now()->subDays(30),
            'this_year' => Carbon::now()->startOfYear(),
            'all_time' => Carbon::createFromTimestamp(0),
            default => Carbon::now()->subDays(7), // 7_days
        };

        $visitors = Visitor::where('created_at', '>=', $startDate)->get();
        $waClicks = WaClick::where('created_at', '>=', $startDate)->get();

        $totalVisitors = $visitors->count();
        $uniqueVisitors = $visitors->unique('ip_address')->count();
        $totalWaClicks = $waClicks->count();
        
        $conversionRate = 0;
        if ($uniqueVisitors > 0) {
            $conversionRate = round(($totalWaClicks / $uniqueVisitors) * 100, 1);
        }

        // Popular Pages (Top 10)
        $popularPages = $visitors->groupBy('page_url')
            ->map(function ($group) {
                return [
                    'url' => $group->first()->page_url,
                    'title' => $group->first()->page_title,
                    'views' => $group->count(),
                    'unique_views' => $group->unique('ip_address')->count()
                ];
            })
            ->sortByDesc('views')
            ->take(10);

        // WA Click Sources (Top 10)
        $waSources = $waClicks->groupBy('source')
            ->map(function ($group) {
                return [
                    'source' => $group->first()->source,
                    'url'    => $group->first()->page_url,
                    'title'  => $group->first()->page_title,
                    'clicks' => $group->count()
                ];
            })
            ->sortByDesc('clicks')
            ->take(10);

        // Chart Data (Group by Date)
        $chartDates = [];
        $visitorChartData = [];
        $waChartData = [];

        // Generate date range for chart
        $days = $period === 'today' ? 1 : ($period === '30_days' ? 30 : ($period === 'this_year' ? Carbon::now()->dayOfYear : ($period === 'all_time' ? 30 : 7)));
        if ($period === 'all_time' || $period === 'this_year') {
             // For large ranges, maybe group by month, but for simplicity we'll just group by date for the last 30 entries if all_time
             // A better approach for all_time is to just pull distinct dates
             $allDates = $visitors->pluck('created_at')->map->format('Y-m-d')->concat($waClicks->pluck('created_at')->map->format('Y-m-d'))->unique()->sort();
             foreach($allDates as $date) {
                 $chartDates[] = Carbon::parse($date)->format('d M');
                 $visitorChartData[] = $visitors->filter(fn($v) => $v->created_at->format('Y-m-d') === $date)->count();
                 $waChartData[] = $waClicks->filter(fn($w) => $w->created_at->format('Y-m-d') === $date)->count();
             }
        } else {
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->format('Y-m-d');
                $chartDates[] = Carbon::now()->subDays($i)->format('d M');
                
                $visitorChartData[] = $visitors->filter(fn($v) => $v->created_at->format('Y-m-d') === $date)->count();
                $waChartData[] = $waClicks->filter(fn($w) => $w->created_at->format('Y-m-d') === $date)->count();
            }
        }

        return view('admin.analytics.index', compact(
            'period', 'totalVisitors', 'uniqueVisitors', 'totalWaClicks', 'conversionRate',
            'popularPages', 'waSources', 'chartDates', 'visitorChartData', 'waChartData'
        ));
    }
}
