<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id')->unsigned();

            $table->string('from_truck');
            $table->string('to_truck');
            $table->text('remarks');
            $table->timestamp('return_date');
            $table->timestamp('transfer_date');
            $table->boolean('availability')->default(1);
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('drivers')
                   ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
