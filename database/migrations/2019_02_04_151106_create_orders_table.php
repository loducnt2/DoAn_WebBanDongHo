<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
			$table->integer('idEmployee')->unsigned();
            $table->foreign('idEmployee')->references('id')->on('employees');
			$table->string('delivery_phone');
			$table->string('delivery_address');
			$table->string('note_order');
			$table->integer('status_order');
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
        Schema::dropIfExists('orders');
    }
}
