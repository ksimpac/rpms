<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thesis;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Thesis::class, function (Faker $faker) {
    return [
        'publicationName' => $faker->realText($faker->numberBetween(10, 20)),
        'publicationDate' => $faker->date('Y/m'),
        'DOI' => $faker->url,
        'authorNo' => $faker->numberBetween(0, 127),
        'order' => $faker->numberBetween(0, 127),
        'rank_factor' => strval($faker->randomNumber) . '/' . strval($faker->randomNumber),
        'corresponding_author' => $faker->boolean(50) === true ? 1 : 0,
        'thesisName' => $faker->realText($faker->numberBetween(10, 20)),
        'type' => $faker->randomElement(array('SCI', 'SCIE', 'SSCI', '其他')),
        'identification' => Str::random(14),
    ];
});
