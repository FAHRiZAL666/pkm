<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('slot', function (Blueprint $table) {
            $table->id('id_slot');
            $table->string('nama_slot', 5);
            $table->enum('status', ['Terisi', 'Kosong']);
            $table->unsignedBigInteger('id_lantai');
            $table->timestamps();

            $table->foreign('id_lantai')->references('id_lantai')->on('lantai')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('slot');
    }
};
