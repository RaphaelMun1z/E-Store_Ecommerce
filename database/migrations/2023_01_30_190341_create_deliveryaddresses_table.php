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
        Schema::create('deliveryaddresses', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('name');
            $table->string('cpf');
            $table->string('cep');
            $table->string('street');
            $table->string('number');
            $table->string('reference');
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
        Schema::dropIfExists('deliveryaddresses');
    }
};
