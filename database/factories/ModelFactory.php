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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('test2016'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    $title = $faker->sentence(mt_rand(2, 5));
    $body = join("\n\n", $faker->paragraphs(mt_rand(3, 6)));

    return [
        'title' => $title,
        'author_id' => mt_rand(1, 3),
        'slug' => str_slug($title),
        'body' => $body,
        'excerpt' => substr($body, 0, 100),
        'active' => 1,
        'published_at' => $faker->dateTimeBetween('-1 month','+10 days'),
    ];
});