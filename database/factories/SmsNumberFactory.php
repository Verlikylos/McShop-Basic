<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SmsNumber;
use Faker\Generator as Faker;

$factory->define(SmsNumber::class, function (Faker $faker) {
    $smsOperators = array_keys(config('mcshop.sms_operators'));
    $number = (string) $faker->e164PhoneNumber();

    return [
        'operator' => $smsOperators[rand(0, strlen($smsOperators) - 1)],
        'number' => substr($number, strlen($number) / 2, strlen($number)),
        'netto_cost' => rand(1, 25) * 100
    ];
});
