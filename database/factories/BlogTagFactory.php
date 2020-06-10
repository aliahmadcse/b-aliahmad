<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogTag;
use Faker\Generator as Faker;

$factory->define(BlogTag::class, function (Faker $faker) {
    return [
        'tag' => $faker->word,
    ];
});
