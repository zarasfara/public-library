<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorStat;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

final class VisitorStatController extends Controller
{
    public function index(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        // Получаем количество недель, для которых нужно вычислить прогноз
        $numberPassedWeeks = (int) $request->query('number_passed_weeks', 4);

        // Получаем статистику за последние N недель
        $visitorStats = VisitorStat::query()
            ->orderBy('week_start', 'desc') // Сортировка по убыванию даты
            ->limit($numberPassedWeeks)
            ->get(['week_start', 'visitors']);

        $visitorStats = $visitorStats->reverse();

        // Извлекаем недели и данные посещаемости без реверсирования для расчёта
        $labels = $visitorStats->pluck('week_start')->map(fn ($date) => date('W', strtotime($date)))->toArray();
        $visitorData = $visitorStats->pluck('visitors')->toArray();

        // Получаем метод прогноза, если не указан — используем стандартный
        $predictionMethod = $request->query('prediction_method', VisitorStat::SIMPLE_PREDICTION_METHOD);

        // Рассчитываем прогноз в зависимости от выбранного метода
        $forecast = match ($predictionMethod) {
            VisitorStat::EXPONENTIAL_PREDICTION_METHOD => VisitorStat::calculateExponentialMovingAverage($visitorData),
            default => VisitorStat::calculateSimpleMovingAverage($visitorData, 3),
        };

        // Реверсируем массивы для корректного отображения в графике
        $reversedLabels = array_reverse($labels);
        $reversedVisitorData = array_reverse($visitorData);

        // Добавляем предсказанное значение в массив данных и меток
        $reversedVisitorData[] = $forecast['forecast'];
        $reversedLabels[] = 'Предсказанное';

        // Возвращаем данные в представление (график)
        return view('admin.pages.visitors.index', [
            'labels' => json_encode($reversedLabels),
            'visitorData' => json_encode($reversedVisitorData),
            'forecast' => $forecast['forecast'],
            'averageRelativeError' => $forecast['average_relative_error'],
            'predictionMethod' => $predictionMethod,
        ]);
    }
}
