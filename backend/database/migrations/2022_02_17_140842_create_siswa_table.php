<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama');
            $table->uuid('kelas_id')->nullable();
            $table->uuid('sekolah_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            //relasi
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
