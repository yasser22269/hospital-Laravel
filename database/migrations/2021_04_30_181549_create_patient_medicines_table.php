<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medicines', function (Blueprint $table) {
            $table->Increments('id');

                $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')
            ->on('patients')->onUpdate('cascade')->onDelete('set null');

                $table->integer('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')->references('id')
            ->on('admins')->onUpdate('cascade')->onDelete('set null');

                 $table->integer('medicine_id')->unsigned()->nullable();
            $table->foreign('medicine_id')->references('id')
            ->on('medicines')->onUpdate('cascade')->onDelete('set null');

            $table->text('reason');
            $table->integer('hourTime');
            $table->tinyInteger('active');
            $table->integer('doseAmount'); //الجرعة


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_medicines');
    }
}
