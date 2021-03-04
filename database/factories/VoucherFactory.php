<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Service;
use App\Models\Voucher;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Voucher::class, function (Faker $faker) {
    $servicesCount = Service::count();
    $usagesAmount = rand(1, 10);
    $usedBy = [];
    
    for ($i = 0; $i < $usagesAmount - rand(0, $usagesAmount); $i++) {
        $usedBy[] = $faker->firstName;
    }
    
    return [
        'service_id' => rand(1, $servicesCount),
        'code' => 'mcshop-'  . Str::random(16),
        'usages_amount' => $usagesAmount,
        'many_usages_per_player' => rand(0, 1),
        'used_by' => $usedBy,
        'status' => count($usedBy) >= $usagesAmount ? 'USED' : 'ACTIVE'
    ];
});
