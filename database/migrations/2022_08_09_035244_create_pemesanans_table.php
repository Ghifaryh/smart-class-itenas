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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ruangan');
            $table->foreignId('id_dosen');
            $table->date('tanggal_masuk');
            $table->dateTime('jadwal_masuk');
            $table->dateTime('jadwal_keluar');
            $table->string('jurusan');
            $table->string('matakuliah');
            $table->foreignId('id_status');
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
        Schema::dropIfExists('pemesanans');
    }
};
