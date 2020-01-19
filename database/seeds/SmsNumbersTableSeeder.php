<?php

use App\Models\SmsNumber;
use Illuminate\Database\Seeder;

class SmsNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SmsNumber::class, rand(50, 100))->create();
    }
}
