<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Other;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Other::class, function (Faker $faker) {
    return [
        'identification' => Str::random(14),
    ];
});
