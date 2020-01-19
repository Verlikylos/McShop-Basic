<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->unsignedBigInteger('server_id');
            $table->string('image_url');
            $table->text('description');
            $table->boolean('require_online_player');
            $table->text('commands');
            $table->unsignedBigInteger('smsnumber_id');
            $table->unsignedBigInteger('psc_cost');
            $table->unsignedBigInteger('transfer_cost');
            $table->unsignedBigInteger('paypal_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
