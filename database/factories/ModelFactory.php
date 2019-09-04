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

$factory->define(App\Author::class, function (Faker\Generator $faker) {
    $hasher = app()->make('hash');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password'=>$hasher->make("secret"),
        'github'=>$faker->sentence(4),
        'twitter'=>$faker->sentence(4),
        'location'=>$faker->sentence(4),
        'latest_article_published'=>$faker->sentence(4)
    ];
});


$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'main_title' => $faker->sentence(4),
        'secondary_title' => $faker->sentence(4),
        'content' => $faker->paragraph(2),
        'image'=> $faker->image,
        'author_id' => mt_rand(1, 10)
    ];
});

