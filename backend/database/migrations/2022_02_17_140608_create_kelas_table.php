<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->uuid('sekolah_id');
            $table->uuid('guru_id')->nullable();
            $table->timestamps();
            // relasi
            $table->foreign('sekolah_id')->references('id')->on('sekolah');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('set null');

            //unique
            $table->unique(['nama', 'sekolah_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
