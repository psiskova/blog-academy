<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Article::class, 20)->create();

        factory(App\Models\Article::class, 'published', 20)->create();
    }
}
