<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checking because truncate() will fail
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // Author::truncate();
        // Article::truncate();
        factory(Author::class, 10)->create();
        factory(Article::class, 50)->create();
        // Enable it back
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    
}
