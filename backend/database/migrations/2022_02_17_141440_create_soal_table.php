<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('soal');
            $table->text('rumusan_kebutuhan');
            $table->text('materi');
            $table->text('tujuan_layanan');
            $table->text('komponen_layanan');
            $table->text('strategi_layanan');
            $table->uuid('bidang_id');
            $table->uuid('kompetensi_id');
            $table->timestamps();
            // relasi
            $table->foreign('bidang_id')->references('id')->on('bidang');
            $table->foreign('kompetensi_id')->references('id')->on('kompetensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal');
    }
}
