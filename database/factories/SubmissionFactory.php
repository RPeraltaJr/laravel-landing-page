<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Submission;
use Faker\Generator as Faker;

$factory->define(Submission::class, function (Faker $faker) {
    return [
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->lastName,
        'city'          => $faker->city,
        'state'         => $faker->stateAbbr,
        'zipcode'       => substr($faker->postcode, 0, 5),
        'email'         => $faker->unique()->safeEmail,
        'phone'         => "555-555-5555",
        'cdla'          => $faker->randomElement(['Yes', 'No']),
        'experience'    => $faker->randomElement(['Yes', 'No']),
        'confirm'       => 1,
    ];
});
