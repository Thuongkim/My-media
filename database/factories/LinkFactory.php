<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'link' => $faker->text,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
