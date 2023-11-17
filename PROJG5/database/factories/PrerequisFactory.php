<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Prerequis;

$factory->define(Prerequis::class, function (Faker $faker) {
    return [
        'ue_id' => $faker->word(),
        'prerequis' => $faker->word()
    ];
});
