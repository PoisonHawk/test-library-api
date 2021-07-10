<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 60; $i++) {
            Book::factory()
                ->hasAttached(
                    Author::inRandomOrder()->limit(rand(1, 3))->get()
                )
                ->create();
        }
    }
}
