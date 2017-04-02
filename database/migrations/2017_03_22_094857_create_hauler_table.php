<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haulers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('vendor_name')->nullable();
            $table->boolean('availability')->default(1);
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
        Schema::dropIfExists('haulers');
    }
}
