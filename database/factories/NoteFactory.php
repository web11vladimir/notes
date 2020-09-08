<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Note;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->text(),
        'category_id' => rand(1, 2),
    ];
});
