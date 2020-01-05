<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image_url');
            $table->string('display_address');
            $table->enum('connection_method', ['rcon', 'api']);
            $table->ipAddress('ip_address')->nullable(true);
            $table->string('port')->nullable(true);
            $table->string('rcon_port')->nullable(true);
            $table->string('rcon_password')->nullable(true);
            $table->string('api_address')->nullable(true);
            $table->string('api_key')->nullable(true);
            $table->boolean('announcement_enabled')->default(false);
            $table->boolean('announcement_content')->nullable(true);
            $table->boolean('enabled')->default(true);
            $table->unsignedInteger('sort_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
