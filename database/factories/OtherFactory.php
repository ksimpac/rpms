<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Other;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;

$factory->define(Other::class, function (Faker $faker) {
    return [
        'username' => User::all()->random(),
        'identification' => Str::random(14),
    ];
});
