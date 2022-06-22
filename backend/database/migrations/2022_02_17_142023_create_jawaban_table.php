<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jawaban');
            $table->uuid('siswa_id');
            $table->uuid('ujian_id');
            $table->uuid('soal_id');
            $table->timestamps();
            //relasi
            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('ujian_id')->references('id')->on('ujian');
            $table->foreign('soal_id')->references('id')->on('soal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban');
    }
}
