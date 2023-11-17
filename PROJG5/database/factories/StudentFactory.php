<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Student;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'numbers' => $faker->randomDigitNotNull,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName
    ];
});
