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
            $table->uuid('rumusan_kebutuhan_id')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
            // relasi
            $table->foreign('rumusan_kebutuhan_id')->references('id')->on('rumusan_kebutuhan')->cascade('set null');
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
