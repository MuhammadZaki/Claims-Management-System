<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->integer('patient_id');
            $table->integer('company_id');
            $table->integer('service_id');
            $table->integer('hp_id');
            $table->string('cost');
            $table->enum('status', ['pending','transferred', 'rejected'])->default('pending');
            $table->timestamps();
        });
//
//        Schema::table('claims', function (Blueprint $table) {
//            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
//        });
//
//        Schema::table('claims', function (Blueprint $table) {
//            $table->foreign('service_id')->references('id')->on('medical_services')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
