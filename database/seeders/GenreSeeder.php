<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $genres = [
            ['name' => 'Фантастика'],
            ['name' => 'Роман'],
            ['name' => 'Детектив'],
            ['name' => 'Приключения'],
            ['name' => 'Фэнтези'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
