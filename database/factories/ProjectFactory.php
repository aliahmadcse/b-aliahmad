<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $project_category_ids = DB::table('project_categories')->pluck('id')->all();

    return [
        'project_category_id' => $faker->randomElement($project_category_ids),
        'title' => $faker->realText(10),
        'description' => $faker->realText(50),
        'image' => $faker->imageURL($width = 1000, $height = 1000),
        'display_order' => $faker->numberBetween($min = 1, $max = 1000),
        'github' => $faker->url,
        'live' => $faker->url
    ];
});
