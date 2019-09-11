<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('status_id')->unsigned()->index()->default(4);
            $table->foreign('status_id')->references('id')->on('car_statuses');
            $table->bigInteger('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('car_types');
            $table->bigInteger('driver_id')->unsigned()->index()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');
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
        Schema::dropIfExists('cars');
    }
}
