<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// SKKPD adalah singkatan dari Standar Kompetensi Kemandirian Peserta Didik
class CreateSkkpdTable extends Migration
{
    
    public function up()
    {
        Schema::create('skkpd', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('introduction');
            $table->string('accommodation');
            $table->string('action');
            $table->uuid('field_component_id');
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
            // relasi
            $table->foreign('field_component_id')->references('id')->on('field_components')->onDelete('cascade');
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
