<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Tutor::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 51),
        'type_of_tutor' => rand(1,3),
        'introduction' => $faker->text,
        'tag' => $faker->unique()->name
    ];
});
