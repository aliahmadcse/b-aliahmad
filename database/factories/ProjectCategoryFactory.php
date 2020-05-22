<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProjectCategory;
use Faker\Generator as Faker;

$factory->define(ProjectCategory::class, function (Faker $faker) {
    $categories = ['web', 'ml'];
    $index = array_rand($categories, 1);
    return [
        'category' => $categories[1]
    ];
});
