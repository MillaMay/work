<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3), // 3 слова
        'description' => $faker->text,
        'video' => Str::random(5),
    ];
});
