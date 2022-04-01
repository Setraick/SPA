<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->string('title');
            $table->string('queue');
            $table->string('priority');
            $table->string('responsible');
            $table->string('lock');
            $table->timestamp('created');
            $table->string('changed');
            $table->string('state_type');
            $table->string('owner');
            $table->string('age');
            $table->string('ticket_number');
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
        Schema::dropIfExists('tickets');
    }
}
