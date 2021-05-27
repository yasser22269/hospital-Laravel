<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangesBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changes_beds', function (Blueprint $table) {
            $table->Increments('id');

                $table->integer('patient_id')->unsigned()->nullable();
                
            $table->foreign('patient_id')->references('id')
                ->on('patients')->onUpdate('cascade')->onDelete('set null');

                $table->integer('fromBed_id')->unsigned()->nullable();
                $table->integer('toBed_id')->unsigned()->nullable();

            $table->foreign('toBed_id')->references('id')
            ->on('beds')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('fromBed_id')->references('id')
            ->on('beds')->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('changes_beds');
    }
}
