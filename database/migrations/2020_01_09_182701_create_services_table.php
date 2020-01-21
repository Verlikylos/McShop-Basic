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
            $table->boolean('requires_online_player');
            $table->text('commands');
            $table->unsignedBigInteger('smsnumber_id')->nullable(true);
            $table->unsignedBigInteger('psc_cost');
            $table->unsignedBigInteger('transfer_cost');
            $table->unsignedBigInteger('paypal_cost');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sort_id');
    
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
            $table->foreign('smsnumber_id')->references('id')->on('sms_numbers')->onDelete('cascade');
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
