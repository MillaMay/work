<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'avatar' => $faker->imageUrl($width = 400, $height = 200),
        'email' => $faker->freeEmail,
        'phone' => $faker->e164PhoneNumber,
        'password' => md5('password'),
        'city' => $faker->city,
        'store' => $faker->sentence(1),
        'post' => $faker->streetAddress,
        'type' => $faker->boolean,
    ];
});
