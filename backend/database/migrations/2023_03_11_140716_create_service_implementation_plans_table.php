<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceImplementationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_implementation_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid("survey_id");
            $table->uuid("survey_item_id");
            $table->uuid('school_id');
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
            //relasi
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('survey_item_id')->references('id')->on('survey_items')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_implementation_plans');
    }
}
