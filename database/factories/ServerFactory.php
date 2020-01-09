<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Server;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Server::class, function (Faker $faker) {
    $rand = rand(0, 100);
    $nameParts = explode('.', $faker->domainName);
    $nameParts[0] .= $rand;
    $name = $nameParts[1] . '_' . $nameParts[0];
    $sanitizedName = Str::ucfirst(Str::camel(str_replace('.', '_', $name)));
    $connectionMethod = rand(0, 1) ? 'api' : 'rcon';
    $announcement = rand(0, 1);

    return [
        'name' => $sanitizedName,
        'image_url' => 'https://via.placeholder.com/512x512?text=' . $sanitizedName,
        'display_address' => $nameParts[0] . '.' . $nameParts[1],
        'connection_method' => $connectionMethod,
        'ip_address' => $connectionMethod == 'rcon' ? $faker->ipv4 : null,
        'port' => $connectionMethod == 'rcon' ? rand(49152, 65535) : null,
        'rcon_port' => $connectionMethod == 'rcon' ? rand(49152, 65535) : null,
        'rcon_password' => $connectionMethod == 'rcon' ? $faker->password(5, 10) : null,
        'api_address' => $connectionMethod == 'api' ? 'http://' . $faker->domainName . '/mcshop' : null,
        'api_key' => $connectionMethod == 'api' ? Str::random(16) : null,
        'announcement_enabled' => $announcement,
        'announcement_content' => $announcement ? $faker->paragraph() : null,
        'active' => rand(0, 1),
        'sort_id' => rand(0, 1000),
    ];
});
