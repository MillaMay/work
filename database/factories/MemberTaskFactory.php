<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MemberTask;
use Faker\Generator as Faker;

$factory->define(MemberTask::class, function (Faker $faker) {
    return [
        'point' => $faker->numberBetween(1, 9),
    ];
});
