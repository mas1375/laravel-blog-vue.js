<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;
use BlogArticleFaker\FakerProvider as Article;


$factory->define(Post::class, function (Faker $faker) {
    // the article Faker
    $faker->addProvider(new Article($faker));

    // getting some sandom image and save it
    $url = $faker->imageUrl(1920,1080, 'city');
    $ext = 'jpg';
    $contents = file_get_contents($url);
    $filename = substr($url, strrpos($url, '/') + 2);
    $fileNameToStore = $filename.'_'.time().'.'.$ext;
    Storage::put('public/cover_images/'.$fileNameToStore, $contents);
    
    return [
        'title' => $faker->articleTitle(),
        'body' => $faker->articleContentMarkdown(),
        'cover_image' => $fileNameToStore,
    ];
});
