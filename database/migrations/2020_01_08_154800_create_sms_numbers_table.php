<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('provider', array_keys(config('mcshop.payment_providers.sms')));
            $table->string('number');
            $table->unsignedBigInteger('netto_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_numbers');
    }
}
