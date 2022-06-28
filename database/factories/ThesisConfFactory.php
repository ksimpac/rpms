<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thesis_conf;
use Faker\Generator as Faker;

$factory->define(Thesis_conf::class, function (Faker $faker) {
    return [
        'conf_name' => $faker->realText($faker->numberBetween(10, 20)),
        'thesisName' => $faker->realText($faker->numberBetween(10, 20)),
        'years' => $faker->year,
        'authorNo' => $faker->numberBetween(0, 127),
        'corresponding_author' => $faker->boolean(50) === true ? 1 : 0,
        'country' => $faker->countryCode,
    ];
});
