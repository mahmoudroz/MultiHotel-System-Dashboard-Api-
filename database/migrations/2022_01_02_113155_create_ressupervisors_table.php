<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRessupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ressupervisors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supervisor_id')->unsigned();
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('floor_id')->unsigned();
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->bigInteger('hotel_id')->nullable();
            $table->integer('from_room_id')->nullable();
            $table->integer('to_room_id')->nullable();
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
        Schema::dropIfExists('ressupervisors');
    }
}
