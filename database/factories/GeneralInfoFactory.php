<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\User;
use App\General_info;
use Illuminate\Support\Str;

$factory->define(General_info::class, function (Faker $faker) {
    $user = User::all()->random();
    return [
        'username' => $user->username,
        'englishLastName' => \Faker\Factory::create('en_US')->lastName,
        'englishFirstName' => \Faker\Factory::create('en_US')->FirstName,
        'birthday' => $faker->date,
        'sex' => substr($user->National_ID_No, 1, 1) == '2' ? '0' : '1',
        'telephone' => PhoneNumber($faker),
        'Permanent_Address' => $faker->address,
        'Residential_Address' => $faker->address,
        'teacherCertificateType' => $faker->randomElement(array('教授', '副教授', '助理教授', '講師', '無')),
        'teacherCertificateFiles' => Str::random(14),
        'working_units' => $faker->bs,
        'position' => $faker->jobTitle,
        'startDate' => $faker->date('Y/m', 'now'),
        'specialization' => $faker->randomElement(array('智慧流通', '物流運輸', '新零售', '其他')),
        'course' => $faker->realText($faker->numberBetween(10, 50)),
    ];
});

function PhoneNumber(Faker $faker)
{
    do {
        $phoneNumber = $faker->phoneNumber;
    } while (strlen($phoneNumber) != 10);

    return $phoneNumber;
}
