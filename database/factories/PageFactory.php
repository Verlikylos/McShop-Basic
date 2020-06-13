<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    $faIconClassesApi = 'https://gist.githubusercontent.com/Verlikylos/2d58a90b175180423b105e8d3f144988/raw/ff991a4e70f8a22c7d53f6ab5200658b8f3ec167/Font%2520Awesome%25205%2520Free%2520%257C%2520Icon%2520classes%2520set%2520JSON';
    $faIconClasses = json_decode(file_get_contents($faIconClassesApi));
    $faIconsCount = count($faIconClasses);

    $type = rand(0, 1) ? 'PAGE' : 'LINK';
    $name = $faker->unique()->jobTitle;

    return [
        'name' => $name,
        'slug' => str_replace('+', '-', strtolower(urlencode($name))),
        'icon' => $faIconClasses[rand(0, $faIconsCount - 1)],
        'type' => $type,
        'content' => $type == 'LINK' ? $faker->url : $faker->paragraph,
        'active' => rand(0, 1),
        'sort_id' => $faker->unique()->numberBetween(0, 1000),
    ];
});
