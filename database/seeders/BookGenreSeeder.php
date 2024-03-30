<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $genres = Genre::all();

        foreach ($books as $book) {
            $randomGenres = $genres->random(rand(1, 3));

            foreach ($randomGenres as $genre) {
                $book->genres()->attach($genre->id);
            }
        }
    }
}
