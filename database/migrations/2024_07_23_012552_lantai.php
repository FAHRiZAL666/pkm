<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lantai', function (Blueprint $table) {
            $table->id('id_lantai');
            $table->string('nama_lantai', 5);
            $table->string('denah', 50);
            $table->unsignedBigInteger('id_mall');
            $table->timestamps();

            $table->foreign('id_mall')->references('id_mall')->on('mall')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lantai');
    }
};
