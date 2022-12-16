<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumusanKebutuhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumusan_kebutuhan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('tujuan_layanan');
            $table->uuid('materi_id')->nullable();
            $table->uuid('skkpd_id');
            $table->timestamps();
            // relasi
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('set null');
            $table->foreign('skkpd_id')->references('id')->on('skkpd')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rumusan_kebutuhan');
    }
}
