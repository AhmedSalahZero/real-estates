<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estate_name' , 100);
            $table->string('estate_price',100);
            $table->tinyInteger('estate_rent');
            $table->string('estate_area' , 10);
            $table->tinyInteger('estate_type');
            $table->string('estate_small_desc',160);
            $table->longText('estate_large_desc');
            $table->string('estate_keywords',200);
            $table->string('estate_longitude',50);
            $table->string('estate_latitude',50);
            $table->tinyInteger('estate_rooms' );
            $table->integer('user_id');
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
        Schema::dropIfExists('estates');
    }
}
