<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trainer;
use Faker\Generator as Faker;
//use Illuminate\Support\Str;

$factory->define(Trainer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'avatar' => $faker->imageUrl($width = 640, $height = 480),
        'email' => $faker->freeEmail,
        'phone' => $faker->e164PhoneNumber,
        'password' => md5('password'),
        'department' => $faker->address,
    ];
});
