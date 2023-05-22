<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceImplementationPlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_implementation_plan_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("value");
            // $table->integer("level");
            $table->uuid("parent_id")->nullable();
            $table->uuid("service_implementation_plan_id")->nullable();
            $table->uuid('school_id')->nullable();
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
            //relasi
            $table->foreign('service_implementation_plan_id', 'sip_id')->references('id')->on('service_implementation_plans')->onDelete('cascade');
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
        Schema::dropIfExists('service_implementation_plan_details');
    }
}
