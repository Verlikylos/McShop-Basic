<?php

use App\Models\Server;
use App\Models\Service;
use App\Models\SmsNumber;
use Illuminate\Database\Seeder;

class ServersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        factory(Server::class, random_int(2, 5))->create()->each(function ($server) {
            $server->services()->saveMany(factory(Service::class, random_int(2, 8))->make([]))->each(function ($service) {
                $service->smsnumber()->associate(factory(SmsNumber::class)->make());
            });
        });

        // When generating services Laravel duplicates server records with different ids, so we need to drop them
        // Related: https://github.com/laravel/framework/issues/19230
        
        foreach (Server::all() as $server) {
            if ($server->services->isEmpty()) {
                $server->delete();
            }
        }
    }
}
