<?php

use App\User;
use Illuminate\Support\Str;
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

$factory->define(\App\Http\Models\UserList::class, function (Faker $faker) {
    return [
        'username' => '',
        'email' => $faker->unique()->safeEmail,
        'token' => $faker->unique()->md5,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'expired_at' => $faker->unixTime(),
        'created_at' => time()
    ];
});
