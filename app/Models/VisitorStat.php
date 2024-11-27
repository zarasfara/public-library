<?php

/** @noinspection PhpUnnecessaryStaticReferenceInspection */

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $week_start
 * @property int $visitors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereVisitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorStat whereWeekStart($value)
 *
 * @mixin \Eloquent
 */
final class VisitorStat extends Model
{
    public const string SIMPLE_PREDICTION_METHOD = 'simple';

    public const string EXPONENTIAL_PREDICTION_METHOD = 'exponential';

    protected $fillable = [
        'week_start',
        'visitors',
    ];

    /**
     * Простое скользящее среднее.
     *
     * Этот метод рассчитывает прогнозное значение (forecast) на основе простого
     * скользящего среднего за заданный период, а также вычисляет среднюю относительную
     * ошибку (average_relative_error) между фактическими и прогнозными данными.
     *
     * @param  array  $data  Массив фактических данных.
     * @param  int  $period  Период для расчета скользящего среднего (количество элементов).
     * @return array{'forecast': int, "average_relative_error": float} Ассоциативный массив с двумя ключами:
     *                                                                 - 'forecast': Предсказанное значение на основе скользящего среднего.
     *                                                                 - 'average_relative_error': Средняя относительная ошибка между
     *                                                                 фактическими и прогнозными данными.
     */
    public static function calculateSimpleMovingAverage(array $data, int $period): array
    {
        $forecast = []; // Массив для хранения прогнозных значений.
        $count = count($data); // Общее количество элементов в массиве данных.

        // Проходим по каждому элементу массива данных.
        for ($i = $period - 1; $i < $count; $i++) {
            // Извлекаем последние $period элементов массива, начиная с текущего индекса.
            $window = array_slice($data, $i - $period + 1, $period);

            // Считаем сумму элементов в окне и делим на период для получения среднего.
            $sum = array_sum($window);
            $forecast[] = $sum / $period; // Добавляем среднее значение в прогнозный массив.
        }

        // Берем последнее предсказанное значение в массиве прогноза.
        $predicted = end($forecast);

        // Возвращаем результат в виде ассоциативного массива.
        return [
            'forecast' => $predicted, // Прогнозируемое значение.
            'average_relative_error' => self::calculateAverageRelativeError($data, $forecast), // Средняя относительная ошибка.
        ];
    }

    /**
     * Экспоненциальное скользящее среднее (EMA).
     *
     * Этот метод рассчитывает прогнозное значение (forecast) на основе экспоненциального
     * скользящего среднего. Оно учитывает как текущее значение, так и предыдущие значения
     * с использованием коэффициента сглаживания (alpha).
     * Также метод вычисляет среднюю относительную ошибку (average_relative_error).
     *
     * @param  array  $data  Массив фактических данных.
     * @param  float  $alpha  Коэффициент сглаживания (от 0 до 1), по умолчанию 0.5.
     *                        Чем выше alpha, тем больше влияние текущих данных.
     * @return array{forecast: int, average_relative_error:float } Ассоциативный массив с двумя ключами:
     *                                                             - 'forecast': Прогнозируемое значение на основе EMA.
     *                                                             - 'average_relative_error': Средняя относительная ошибка между
     *                                                             фактическими и прогнозными данными.
     */
    public static function calculateExponentialMovingAverage(array $data, float $alpha = 0.5): array
    {
        $ema = []; // Массив для хранения экспоненциального скользящего среднего.

        // Первое значение EMA равно первому элементу исходных данных.
        $ema[0] = $data[0];

        // Проходим по массиву данных, начиная со второго элемента.
        for ($i = 1; $i < count($data); $i++) {
            // Вычисляем EMA: alpha * текущее значение + (1 - alpha) * предыдущее EMA.
            $ema[] = $alpha * $data[$i] + (1 - $alpha) * $ema[$i - 1];
        }

        // Берем последнее значение EMA как прогноз.
        $predicted = end($ema);

        return [
            'forecast' => $predicted, // Прогнозируемое значение (EMA последнего периода).
            'average_relative_error' => self::calculateAverageRelativeError($data, $ema), // Средняя относительная ошибка.
        ];
    }

    /**
     * Расчет относительных ошибок.
     */
    private static function calculateRelativeErrors(array $actual, array $predicted): array
    {
        $errors = [];
        foreach ($actual as $index => $value) {
            if (isset($predicted[$index])) {
                $errors[] = abs($value - $predicted[$index]) / $value * 100;
            }
        }

        return $errors;
    }

    /**
     * Средняя относительная ошибка.
     */
    private static function calculateAverageRelativeError(array $actual, array $predicted): float
    {
        $errors = self::calculateRelativeErrors($actual, $predicted);

        return array_sum($errors) / count($errors);
    }
}
