<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\VisitorStat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitorStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VisitorStat::truncate();

        for ($i = 10; $i >= 0; $i--) {
            $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();

            VisitorStat::create([
                'week_start' => $weekStart,
                'visitors' => rand(100, 200),
            ]);
        }
    }
}
