<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\UE;

$factory->define(UE::class, function (Faker $faker) {
    return [
        'UE'=>$faker->unique()->word,
        'ECTS'=>Str::random(10),
        'heures'=>Str::random(20),
    ];
});
