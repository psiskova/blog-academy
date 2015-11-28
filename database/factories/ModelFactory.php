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
        'profileimage' => substr(str_replace(storage_path(), '', $faker->image(storage_path(), 640, 480, 'people')), 1)
    ];
});

$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'user_id' => App\Models\User::all()->random()->id,
        'text' => $faker->text(800)
    ];
});

$factory->defineAs(App\Models\Article::class, 'withTask', function (Faker\Generator $faker) use ($factory) {
    $article = $factory->raw(App\Models\Article::class);

    return array_merge($article, [
        'task_id' => App\Models\Task::all()->random()->id
    ]);
});

$factory->defineAs(App\Models\Article::class, 'published', function (Faker\Generator $faker) use ($factory) {
    $article = $factory->raw(App\Models\Article::class);

    return array_merge($article, [
        'state' => \App\Models\Article::PUBLISHED
    ]);
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Models\ArticleTagMapper::class, function (Faker\Generator $faker) {
    return [
        'article_id' => App\Models\Article::all()->random()->id,
        'tag_id' => App\Models\Tag::all()->random()->id
    ];
});

$factory->define(App\Models\Course::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'year' => $faker->year,
        'user_id' => App\Models\User::all()->random()->id
    ];
});

$factory->define(App\Models\Task::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'course_id' => App\Models\Course::all()->random()->id
    ];
});

$factory->define(App\Models\Discussion::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'text' => $faker->text($faker->numberBetween(100, 400)),
        'article_id' => App\Models\Article::all()->random()->id,
        'parent' => ($faker->boolean(70) && App\Models\Discussion::all()->count() > 0) ? App\Models\Discussion::all()->random()->id : null
    ];
});

$factory->define(App\Models\Rating::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'article_id' => App\Models\Article::all()->random()->id,
        'rating' => $faker->numberBetween(1, 5)
    ];
});