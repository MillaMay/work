<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'logo' => $faker->imageUrl($width = 400, $height = 200), //эти есть картинки
        'title' => $faker->company,
        'description' => $faker->text,
    ];
});
