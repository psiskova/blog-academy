<?php

use Illuminate\Database\Seeder;

class RatingTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(App\Models\Rating::class, 500)->create();
    }
}
