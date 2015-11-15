<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'user_id' => App\Models\User::all()->random()->id,
        'text' => $faker->text(800)
    ];
});

$factory->defineAs(App\Models\Article::class, 'published', function (Faker\Generator $faker) use ($factory) {
    $article = $factory->raw(App\Models\Article::class);

    return array_merge($article, [
        'state' => \App\Models\Article::PUBLISHED
    ]);
});