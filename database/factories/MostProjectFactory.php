<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Most_project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Most_project::class, function (Faker $faker) {
    return [
        'projectName' => $faker->realText($faker->numberBetween(10, 20)),
        'startDate' => $faker->date('Y/m/d'),
        'endDate' => $faker->date('Y/m/d'),
        'jobkind' => $faker->randomElement(array('主持人', '共同主持人')),
        'plantotal_money' => $faker->randomNumber,
        'identification' => Str::random(14),
    ];
});
