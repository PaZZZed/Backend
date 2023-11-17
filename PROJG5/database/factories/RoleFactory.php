<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Role;
use Illuminate\Support\Str;

use Illuminate\Validation\Rules\Unique;

$factory->define(Role::class, function (Faker $faker) {
    //App\Role::inRandomOrder()->first()
    return [
        'role_id'=>Str::random(10),
        'nom'=>$faker->word(),
        'prenom'=>$faker->word(),
        'role'=>$faker->word(),
        'mdp'=>$faker->word(),
    ];
});
