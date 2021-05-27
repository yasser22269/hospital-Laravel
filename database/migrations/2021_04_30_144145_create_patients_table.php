<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->enum('gender',array('male', 'female'));
            $table->tinyInteger('isIsolted')->default(0); // معزول
            $table->dateTime('admitted'); // جه امته
            $table->dateTime('discharged'); // خرج

            $table->integer('bed_id')->unsigned()->nullable();
        $table->foreign('bed_id')->references('id')
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
        Schema::dropIfExists('patients');
    }
}
