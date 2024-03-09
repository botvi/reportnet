<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi');
            $table->unsignedBigInteger('user_id');
            $table->string('admin_jaringan');
            $table->string('telepon');
            $table->string('mac_address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('icon');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instansi');
    }
};