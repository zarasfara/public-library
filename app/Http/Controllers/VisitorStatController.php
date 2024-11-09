<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\VisitorStat;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

final class VisitorStatController extends Controller
{
    public function index(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $numberPassedWeeks = (int) $request->query('number_passed_weeks', 4);

        // Получаем данные для графика
        $visitorStats = VisitorStat::query()
            ->orderBy('week_start', 'desc')
            ->limit($numberPassedWeeks)
            ->get(['week_start', 'visitors'])
            ->reverse();

        $labels = $visitorStats->pluck('week_start')->map(fn ($date) => date('W', strtotime($date)))->toArray();
        $visitorData = $visitorStats->pluck('visitors')->toArray();

        $predictionMethod = $request->query('prediction_method', 'simple');

        $forecast = match ($predictionMethod) {
            'exponential' => VisitorStat::exponentialMovingAverage(weeks: $numberPassedWeeks),
            default => VisitorStat::simpleMovingAverage($numberPassedWeeks),
        };

        $visitorData[] = $forecast;
        $labels[] = 'Предсказанное';

        return view('admin.pages.visitors.index', [
            'labels' => json_encode($labels),
            'visitorData' => json_encode($visitorData),
            'forecast' => $forecast,
            'predictionMethod' => $predictionMethod,
        ]);
    }
}
