<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->enum('type_id',array('blue', 'red', 'free'));

            $table->integer('ward_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('ward_id')->references('id')
            ->on('wards')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
