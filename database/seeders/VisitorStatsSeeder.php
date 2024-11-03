<?php

namespace Database\Seeders;

use App\Models\VisitorStat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visitor_stats')->truncate();

        for ($i = 3; $i > 0; $i--) {
            $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();

            VisitorStat::create([
                'week_start' => $weekStart,
                'visitors' => rand(100, 200),
            ]);
        }
    }
}
