<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mall', function (Blueprint $table) {
            $table->id('id_mall');
            $table->string('nama_mall', 50);
            $table->string('gambar', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mall');
    }
};
