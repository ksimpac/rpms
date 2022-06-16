<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Industry_experience;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;

$factory->define(Industry_experience::class, function (Faker $faker) {
    return [
        'username' => User::all()->random(),
        'working_units' => $faker->catchPhrase,
        'position' => $faker->jobTitle,
        'type' => $faker->randomElement(array('兼任', '專任')),
        'job_description' => $faker->realText($faker->numberBetween(10, 20)),
        'startDate' => $faker->date('Y/m'),
        'endDate' => $faker->date('Y/m'),
        'identification' => Str::random(14),
    ];
});
