<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\VisitorStat;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

final class TrackVisitor
{
    /**
     * Обработка входящего запроса.
     */
    public function handle(Request $request, Closure $next)
    {
        // Определение начала текущей недели
        $currentWeekStart = Carbon::now()->startOfWeek()->toDateString(); // Формат YYYY-MM-DD

        $currentDay = Carbon::now()->toDateString();

        // Проверка: если в сессии отсутствует отметка о текущей неделе
        if (session()->get('visited_today') !== $currentDay) {

            session()->put('visited_today', $currentDay);

            $visitorStat = VisitorStat::firstOrCreate(
                ['week_start' => $currentWeekStart],
                ['visitors' => 0]
            );

            $visitorStat->increment('visitors');
        }

        return $next($request);
    }
}
