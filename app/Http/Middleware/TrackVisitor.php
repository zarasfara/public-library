<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorStat;
use Carbon\Carbon;

final class TrackVisitor
{
    /**
     * Обработка входящего запроса.
     */
    public function handle(Request $request, Closure $next)
    {
        // Определение начала текущей недели
        $currentWeekStart = Carbon::now()->startOfWeek()->toDateString(); // Формат YYYY-MM-DD

        // Проверка: если в сессии отсутствует отметка о текущей неделе
        if (session()->get('visited_this_week') !== $currentWeekStart) {

            // Обновляем отметку с началом недели
            session()->put('visited_this_week', $currentWeekStart);

            // Получение или создание записи для текущей недели
            $visitorStat = VisitorStat::firstOrCreate(
                ['week_start' => $currentWeekStart],
                ['visitors' => 0]
            );

            // Увеличение счетчика посещений на 1
            $visitorStat->increment('visitors');
        }

        return $next($request);
    }
}

