<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Blog::class, function (Faker $faker) {
    $blog_tag_ids = DB::table('blog_tags')->pluck('id')->all();

    return [
        'blog_tag_id' => $faker->randomElement($blog_tag_ids),
        'author_id' => 1,
        'title' => $faker->sentence($nbWords = 8, $variableNbWords = true),
        'description' => $faker->realText($maxNbChar = 200, $indexSize = 1),
        'body' => $faker->realText($maxNbChar = 2500, $indexSize = 1),
        'image' => $faker->imageUrl($width = 1000, $height = 540),
        'is_published' => 1
    ];
});
