<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $week_start
 * @property int $visitors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereWeekStart($value)
 * @mixin \Eloquent
 */
final class VisitorStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_start',
        'visitors',
    ];

    /**
     * Вычисляет простое скользящее среднее на основе данных о посещениях за несколько недель.
     * Этот метод берет последние `$weeks` значений, суммирует их и делит на количество значений.
     * Используется для усреднения значений без учета весов.
     *
     * @param int $weeks Количество недель, по которым будет рассчитано скользящее среднее.
     *                   По умолчанию значение равно 4, что позволяет взять последние 4 недели.
     * @return int Прогнозируемое значение количества посещений на основе простого скользящего среднего.
     */
    public static function simpleMovingAverage(int $weeks = 4): int
    {
        /* @var $visitorData int[] */
        $visitorData = self::query()
            ->orderBy('week_start', 'desc')
            ->limit($weeks)
            ->pluck('visitors')
            ->toArray();

        return round(array_sum($visitorData) / count($visitorData));
    }

    /**
     * Вычисляет экспоненциальное скользящее среднее на основе данных о посещениях за несколько недель.
     * Этот метод применяет сглаживание к данным, придавая большее значение недавним записям.
     * Коэффициент сглаживания `$alpha` определяет, насколько сильно учитываются последние значения.
     *
     * Прогноз рассчитывается по формуле:
     *  EMA(t) = alpha * Value(t) + (1 - alpha) * EMA(t - 1),
     * где `EMA(t)` - значение экспоненциального среднего на текущей неделе, а `Value(t)` - посещения на текущей неделе.
     *
     * @param float $alpha Коэффициент сглаживания (от 0 до 1), где большее значение означает больший вес для последних данных.
     *                     Например, значение 0.5 означает, что вес данных убывает с каждой неделей, что делает расчет чувствительным к последним изменениям.
     * @param int $weeks Количество недель, по которым будет рассчитано экспоненциальное скользящее среднее.
     *                   По умолчанию значение равно 4, что позволяет взять последние 4 недели.
     * @return int Прогнозируемое значение количества посещений на основе экспоненциального скользящего среднего.
     */
    public static function exponentialMovingAverage(float $alpha = 0.5, int $weeks = 4): int
    {
        /* @var $visitorData int[] */
        $visitorData = self::query()
            ->orderBy('week_start', 'desc')
            ->limit($weeks)
            ->pluck('visitors')
            ->reverse() // Реверс для начала с самого старого значения
            ->toArray();

        // Начальное значение прогноза устанавливается как первый элемент массива (самая ранняя неделя)
        $forecast = $visitorData[0];

        foreach ($visitorData as $value) {
            $forecast = $alpha * $value + (1 - $alpha) * $forecast;
        }

        return round($forecast);
    }
}

