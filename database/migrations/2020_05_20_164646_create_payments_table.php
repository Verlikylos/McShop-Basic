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
            $table->string('pid')->nullable(true)->unique();
            $table->char('hash', 36)->unique();
            $table->string('type');
            $table->string('provider');
            $table->unsignedBigInteger('cost');
            $table->text('details')->nullable(true);
            $table->enum('status', ['CREATED', 'SUCCESSFUL', 'FAILED', 'CANCELED']);
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
        Schema::dropIfExists('payments');
    }
}
