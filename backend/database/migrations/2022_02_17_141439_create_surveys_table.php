<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('number_of_survey_items');
            $table->string("status")->default("close");
            $table->string("class_name");
            $table->uuid('class_id')->nullable();
            $table->uuid('teacher_id')->nullable();
            $table->uuid('school_id');
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
            //relasi
            $table->foreign('class_id')->references('id')->on('classes')->onDelete("set null");
            $table->foreign('teacher_id')->references('id')->on('teachers');
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
        Schema::dropIfExists('surveys');
    }
}
