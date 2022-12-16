<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkkpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skkpd', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('pengenalan');
            $table->string('akomodasi');
            $table->string('tindakan');
            $table->uuid('bidang_id');
            $table->timestamps();
            // relasi
            $table->foreign('bidang_id')->references('id')->on('bidang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skkpd');
    }
}
