<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

final class VisitorStatController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $visitorStats = DB::table('visitor_stats')
            ->orderBy('week_start', 'desc')
            ->limit(4)
            ->get(['week_start', 'visitors'])
            ->reverse();

        $labels = $visitorStats->pluck('week_start')->map(function ($date) {
            return date('W', strtotime($date));
        })->toArray();

        $visitorData = $visitorStats->pluck('visitors')->toArray();

        $forecast = round(collect($visitorData)->avg());
        $visitorData[] = $forecast;
        $labels[] = 'Forecast';

        return view('admin.pages.visitors.index', [
            'labels' => json_encode($labels),
            'visitorData' => json_encode($visitorData),
            'forecast' => $forecast
        ]);
    }
}
