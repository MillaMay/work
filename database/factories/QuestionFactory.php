<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 10),
        'type' => $faker->boolean,
        'point' => 10,
        'point_accrual' => $faker->boolean,

    ];
});
