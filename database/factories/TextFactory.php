<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Text;
use Faker\Generator as Faker;

$factory->define(Text::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'text' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
