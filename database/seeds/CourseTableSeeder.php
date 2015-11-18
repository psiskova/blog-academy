<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Course::class, 20)->create();
    }
}
