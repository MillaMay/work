<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MemberMaterial;
use Faker\Generator as Faker;

$factory->define(MemberMaterial::class, function (Faker $faker) {
    return [
        'studied' => $faker->boolean,
    ];
});
