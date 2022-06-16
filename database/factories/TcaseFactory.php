<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tcase;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;

$factory->define(Tcase::class, function (Faker $faker) {
    return [
        'username' => User::all()->random(),
        'projectName' => $faker->realText($faker->numberBetween(10, 20)),
        'collaboration_name' => $faker->company,
        'startDate' => $faker->date('Y/m/d'),
        'endDate' => $faker->date('Y/m/d'),
        'jobkind' => $faker->randomElement(array('主持人', '共同主持人')),
        'plantotal_money' => $faker->randomNumber,
        'identification' => Str::random(14),
    ];
});
