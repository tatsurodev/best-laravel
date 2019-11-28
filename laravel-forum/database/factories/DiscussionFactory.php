<?php

use Faker\Generator as Faker;
use LaravelForum\Discussion;

$factory->define(Discussion::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'title' => $faker->words(3, true),
        'content' => $faker->paragraph(3),
        'slug' => str_slug($faker->words(3, true)),
        'channel_id' => $faker->numberBetween(1, 4),
    ];
});
