<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['PSC', 'TRANSFER', 'PAYPAL']);
            $table->string('pid')->nullable(true)->unique();
            $table->char('control', 36)->nullable(true)->unique();
            $table->unsignedBigInteger('cost');
            $table->enum('status', ['CREATED', 'SUCCESSFUL', 'FAILED', 'CANCELED']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
