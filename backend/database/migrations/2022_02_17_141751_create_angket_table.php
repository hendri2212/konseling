<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->datetime('tanggal');
            $table->uuid('kelas_id');
            $table->timestamps();
            //relasi
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angket');
    }
}
