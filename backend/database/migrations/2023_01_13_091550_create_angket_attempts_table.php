<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngketAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angket_attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('angket_id');
            $table->uuid('siswa_id');
            $table->string('state')->default('inprogress');
            $table->timestamp('timestart')->nullable();
            $table->timestamp('timefinish')->nullable();
            $table->timestamps();
            //relasi
            $table->foreign('angket_id')->references('id')->on('angket')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angket_attempts');
    }
}
