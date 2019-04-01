<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name_pro');
			$table->integer('idCategory')->unsigned();
            $table->foreign('idCategory')->references('id')->on('categories');
			$table->string('thumbnail_pro');
			$table->float('price_pro');
			$table->string('material_pro'); 
			$table->float('discount_pro');
			$table->integer('quantity_pro');
			$table->integer('status_pro'); /* Còn hàng - Hết hàng */
			$table->integer('type_pro');  /* Nam - Nữ */	
			$table->string('description_pro');
			$table->integer('idBrand')->unsigned();
            $table->foreign('idBrand')->references('id')->on('brands');
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
        Schema::dropIfExists('products');
    }
}
