<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Chat;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        'sender_user_id' => $faker->numberBetween(1, 20),
        'receiver_user_id' => $faker->numberBetween(1, 20),
        'message' => $faker->text,
    ];
});
