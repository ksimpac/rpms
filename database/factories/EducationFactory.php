<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Education;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;

$factory->define(Education::class, function (Faker $faker) {
    return [
        'username' => User::all()->random(),
        'schoolName' => $faker->company,
        'department' => $faker->companyModifier,
        'startDate' => $faker->date('Y/m'),
        'endDate' => $faker->date('Y/m'),
        'degree' => $faker->randomElement(array('Bachelor', 'Master', 'PhD')),
        'status' => $faker->randomElement(array('畢業', '結業', '肄業')),
        'country' => $faker->countryCode,
        'thesis' => $faker->realText($faker->numberBetween(10, 20)),
        'advisor' => $faker->name,
        'certificate' => Str::random(14),
        'transcript' => Str::random(14),
    ];
});
