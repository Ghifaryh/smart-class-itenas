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
        Schema::create('verif_akuns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('level');
            $table->string('kode_dosen')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('id_status');
            $table->string('password');
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
        Schema::dropIfExists('verif_akuns');
    }
};
