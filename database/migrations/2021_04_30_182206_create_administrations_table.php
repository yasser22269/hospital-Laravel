<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrations', function (Blueprint $table) {
            $table->Increments('id');

            $table->integer('prescription_id')->unsigned()->nullable();
        $table->foreign('prescription_id')->references('id')
        ->on('patient_medicines')->onUpdate('cascade')->onDelete('set null');

            $table->integer('nurse_id')->unsigned()->nullable();
        $table->foreign('nurse_id')->references('id')
        ->on('admins')->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('administrations');
    }
}
