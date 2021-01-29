<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Material;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(1),
        'description' => $faker->text,
        'image' => $faker->imageUrl($width = 400, $height = 200),
        'URL' => $faker->url,
    ];
});
