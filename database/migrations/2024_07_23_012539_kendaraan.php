<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->date('tanggal');
            $table->enum('status', ['Booking', 'Dalam Parkiran', 'Keluar Parkiran']);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_mall')->nullable();
            $table->unsignedBigInteger('id_lantai')->nullable();
            $table->unsignedBigInteger('id_slot')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_mall')->references('id_mall')->on('mall')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_lantai')->references('id_lantai')->on('lantai')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_slot')->references('id_slot')->on('slot')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kendaraan');
    }
};
