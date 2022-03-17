<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nip')->nullable()->unique();
            $table->string('nama')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->nullable();
            $table->uuid('sekolah_id')->nullable();
            $table->uuid('role_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            //relasi
            $table->foreign('sekolah_id')->references('id')->on('sekolah');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru');
    }
}
