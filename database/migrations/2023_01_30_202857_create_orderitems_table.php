<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orderitems')) {
            Schema::create('orderitems', function (Blueprint $table) {
                $table->id();
                $table->integer('order_id')->unsigned();
                $table->foreign('order_id')->references('id')->on('orders');
                $table->integer('product_id')->unsigned();
                $table->foreign('product_id')->references('id')->on('products');
                $table->integer('amount_product');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderitems');
    }
};
