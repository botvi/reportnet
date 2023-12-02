<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('deskripsi_title');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->string('solusi')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

        });
    }

  
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
};
