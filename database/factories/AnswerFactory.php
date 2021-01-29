<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 15),
        'correctly' => $faker->boolean,
        'point' => 1,
    ];
});
