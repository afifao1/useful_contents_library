<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::factory(10)->create();
        Category::factory(10)->create();
        Content::factory(10)->create();
    }
}
