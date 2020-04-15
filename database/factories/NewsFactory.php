<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'description' => $faker->text(200),
        'content' => $faker->realText(),
        'hot' => 1,
        'category_id' => $faker->numberBetween(1, 5),
        'user_id' => 3,
        'status' => 1,
        'image' => $faker->numberBetween(1, 10) . '.jpg',
    ];
});
