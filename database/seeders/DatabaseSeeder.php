<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::factory(3)->has(
            Book::factory()
                ->count(2)
        )->create();
    }
}
