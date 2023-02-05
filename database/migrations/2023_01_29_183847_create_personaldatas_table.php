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
        Schema::create('personaldatas', function (Blueprint $table) {
            $table->integer("user_id")->unique();
            $table->string("name");
            $table->string("lastname");
            $table->string("cpf");
            $table->date("birthdate");
            $table->string("cep");
            $table->string("street");
            $table->string("number");
            $table->string("reference")->nullable();
            $table->string("contact1");
            $table->string("contact2")->nullable();
            $table->string("picture")->nullable();
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
        Schema::dropIfExists('personaldatas');
    }
};
