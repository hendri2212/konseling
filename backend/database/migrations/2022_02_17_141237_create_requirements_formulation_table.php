<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementsFormulationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements_formulation', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('service_objective');
            $table->uuid('topic_id')->nullable();
            $table->uuid('skkpd_id');
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
            // relasi
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('set null');
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
        Schema::dropIfExists('requirements_formulation');
    }
}
