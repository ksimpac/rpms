<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'password' => bcrypt('1234567890'),
        'chineseName' => $faker->name,
        'email' => $faker->email,
        'National_ID_No' => $faker->personalIdentityNumber,
        'email_verified_at' => $faker->unixTime,
        'is_admin' => 0,
        'isSignup' => $faker->boolean(50) === true ? 1 : 0,
    ];
});
