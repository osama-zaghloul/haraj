<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_id');
            $table->integer('code')->nullable();
            $table->string('artitle');
            $table->string('entitle');
            $table->integer('price');
            $table->string('discountprice')->nullable();
            $table->string('offer');
            $table->string('ardesc');
            $table->string('endesc');
            $table->string('whatsapp');
            $table->boolean('suspensed')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
