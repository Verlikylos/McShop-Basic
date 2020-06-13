<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SmsNumber;
use Faker\Generator as Faker;

$factory->define(SmsNumber::class, function (Faker $faker) {
    $smsProviders = array_keys(config('mcshop.payment_providers.sms'));
    $number = (string) $faker->e164PhoneNumber();

    return [
        'provider' => $smsProviders[random_int(0, count($smsProviders) - 1)],
        'number' => substr($number, strlen($number) / 2, strlen($number)),
        'netto_cost' => random_int(1, 25) * 100
    ];
});
