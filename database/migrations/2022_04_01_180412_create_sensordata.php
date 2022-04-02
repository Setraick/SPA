<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensordata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensordata', function (Blueprint $table) {
            $table->id('id_sensordata');
            $table->integer('id_user')->unsigned();
            $table->integer('id_vehicle');
            $table->integer('id_user_foreign_API')->nullable();
            $table->bigInteger('timestamp_API')->nullable();
            $table->float('accelerometerX')->nullable();
            $table->float('accelerometerY')->nullable();
            $table->float('accelerometerZ')->nullable();
            $table->float('gyroscopeX')->nullable();
            $table->float('gyroscopeY')->nullable();
            $table->float('gyroscopeZ')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->float('altitude')->nullable();
            //$table->foreign('id_user')->references('id')->on('users');
            //$table->foreign('id_vehicle')->references('id_vehicle')->on('vehicle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensordata');
    }
}
