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
    Schema::create('lokasis', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->double('latitude');
        $table->double('longitude');
        $table->string('icon_path');
        $table->string('polygon_color')->default('#ff0000'); // Tambahkan kolom polygon_color
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('lokasis');
    }
};
