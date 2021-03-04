<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->char('hash', 36)->unique();
            $table->string('customer');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('payment_id')->nullable(true);
            $table->unsignedBigInteger('profit')->nullable(true);
            $table->enum('status', ['CREATED', 'PAID', 'CANCELED', 'COMPLETED', 'FAILED']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
