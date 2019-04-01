<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_company');
            $table->string('email_company');
            $table->string('phone_company');
            $table->string('address_company');
            $table->string('avatar_company');
            $table->string('link_fb');
            $table->string('link_twiter');
            $table->string('link_youtube');
            $table->string('link_g');
            $table->string('link_vimeo');
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
        Schema::dropIfExists('companies');
    }
}
