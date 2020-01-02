<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Git_user;
use Faker\Generator as Faker;

$factory->define(Git_user::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'git_user' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
