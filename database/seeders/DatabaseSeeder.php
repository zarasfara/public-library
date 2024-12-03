<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            VisitorStatsSeeder::class,
        ]);

        Author::factory(10)->has(
            Book::factory()
                ->count(10)
        )->create();

        $librarian = Role::create(['name' => RoleEnum::LIBRARIAN]);
        $administrator = Role::create(['name' => RoleEnum::ADMINISTRATOR]);
        $secretary = Role::create(['name' => RoleEnum::SECRETARY]);

        /* @var User $user */
        $user = User::factory()->create([
            'name' => 'eugene',
            'email' => 'oev2001@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole($administrator);

        $this->call(BookGenreSeeder::class);

        $this->call(VisitorStatsSeeder::class);
    }
}
