<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('permissions', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->string('permission');
        //     $table->uuid('service_id');
        //     $table->timestamps();

        //     //relasi
        //     $table->foreign('service_id')->references('id')->on('services');

        //     //unique
        //     $table->unique(['permission', 'service_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
