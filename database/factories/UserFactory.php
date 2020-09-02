<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

    $gender = $faker->randomElement(['male', 'female']);
    $name = $faker->name($gender);
    $sex = $gender == "male" ? 'men' : 'women';
    $avatar = 'https://randomuser.me/api/portraits/'.$sex.'/'.$faker->numberBetween(1, 100).'.jpg';

    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'avatar' => $avatar,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
