<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('role_permissions', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->uuid('role_id');
        //     $table->uuid('permission_id');
        //     $table->timestamps();

        //     //relasi
        //     $table->foreign('role_id')->references('id')->on('roles');
        //     $table->foreign('permission_id')->references('id')->on('permissions');

        //     //unique
        //     $table->unique(['role_id', 'permission_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}
