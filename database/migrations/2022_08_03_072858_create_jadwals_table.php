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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan');
            $table->foreignId('id_ruangan');
            $table->foreignId('id_pemesan');
            $table->date('tanggal_pinjam');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->foreignId('prodi');
            $table->string('matakuliah');
            $table->string('kelas');
            $table->string('dosen_matkul');
            $table->string('fileRPS')->nullable();
            $table->string('fileSertif')->nullable();
            $table->string('pesan')->nullable();
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
        Schema::dropIfExists('jadwals');
    }
};
