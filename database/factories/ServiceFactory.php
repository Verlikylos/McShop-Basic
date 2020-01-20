<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Server;
use App\Models\Service;
use App\Models\SmsNumber;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    $name = $faker->unique()->jobTitle();
    
    return [
        'name' => $name,
        'server_id' => factory(Server::class),
        'image_url' => 'https://via.placeholder.com/512x512?text=' . $name,
        'description' => $faker->paragraph(10),
        'requires_online_player' => random_int(0, 1),
        'commands' => $faker->sentences(rand(2, 5)),
        'smsnumber_id' => factory(SmsNumber::class),
        'psc_cost' => random_int(0, 100) * 100,
        'transfer_cost' => random_int(0, 100) * 100,
        'paypal_cost' => random_int(0, 100) * 100,
    ];
});
