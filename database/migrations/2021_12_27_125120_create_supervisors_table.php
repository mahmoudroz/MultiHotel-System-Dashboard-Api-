<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->bigInteger('identity_type_id')->unsigned()->nullable();
            $table->foreign('identity_type_id')->references('id')->on('identity_types')->onDelete('cascade');
            $table->string('IDNum')->nullable();
            $table->string('image')->nullable();
            $table->string('block')->default('unblock')->comment('block unblock');
            $table->string('mobile_token')->nullable();
            $table->bigInteger('hotel_id')->unsigned()->nullable();
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
        Schema::dropIfExists('supervisors');
    }
}
