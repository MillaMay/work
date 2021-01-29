<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'time' => $faker->randomNumber(2), // 2 цифры
        'count_samples' => $faker->numberBetween(1, 5),
        'checkpoint' => $faker->numberBetween(50, 100),
        'max_point' => $faker->numberBetween(150, 200),
    ];
});
