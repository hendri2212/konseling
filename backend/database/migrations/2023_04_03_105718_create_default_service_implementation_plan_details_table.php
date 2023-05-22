<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultServiceImplementationPlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_service_implementation_plan_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('service_strategy')->nullable();
            $table->string("value");
            $table->uuid("default_service_implementation_plan_detail_id")->nullable();
            $table->uuid('school_id')->nullable();
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
            //relasi
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_service_implementation_plan_details');
    }
}
