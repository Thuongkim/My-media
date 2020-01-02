<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Avatar;
use Faker\Generator as Faker;

$factory->define(Avatar::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
