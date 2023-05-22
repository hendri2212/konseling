<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('state')->default('inprogress');
            $table->integer('sumgrades')->nullable();
            $table->uuid('survey_id');
            $table->uuid('student_id');
            $table->uuid('school_id');
            $table->bigInteger('timestart')->nullable();
            $table->bigInteger('timefinish')->nullable();
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
            //relasi
            $table->foreign('survey_id')->references('id')->on('surveys');
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::dropIfExists('angket_attempts');
    }
}
