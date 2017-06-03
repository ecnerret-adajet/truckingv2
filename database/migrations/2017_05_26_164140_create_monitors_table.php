<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('log_ID')->unsigned()->nullable();
            $table->integer('location_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('duration_id')->unsigned();
            $table->integer('detail_id')->unsigned();

            $table->text('remarks');
            $table->integer('odometer')->unsigned();
            $table->boolean('marked')->default(1);

            $table->foreign('user_id')
                   ->references('id')
                   ->on('users')
                   ->onDelete('cascade');

            $table->foreign('location_id')
                   ->references('id')
                   ->on('locations')
                   ->onDelete('cascade');

            $table->foreign('status_id')
                   ->references('id')
                   ->on('statuses')
                   ->onDelete('cascade');

            $table->foreign('duration_id')
                   ->references('id')
                   ->on('durations')
                   ->onDelete('cascade');

            $table->foreign('detail_id')
                   ->references('id')
                   ->on('details')
                   ->onDelete('cascade');

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
        Schema::dropIfExists('monitors');
    }
}
