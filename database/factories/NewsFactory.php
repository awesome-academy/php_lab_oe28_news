<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\News;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(News::class, function (Faker $faker) {
    $created = $faker->dateTimeBetween('this week', '+6 days');
    $title = $faker->text(100);

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->text(200),
        'content' => $faker->realText(),
        'hot' => $faker->numberBetween(0, 1),
        'category_id' => $faker->numberBetween(31, 37),
        'user_id' => $faker->numberBetween(2, 4),
        'status' => $faker->numberBetween(0, 4),
        'image' => $faker->numberBetween(1, 10) . '.jpg',
        'created_at' => $created,
    ];
});
