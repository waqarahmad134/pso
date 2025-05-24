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
        Schema::create('dips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->decimal('price', 10, 2);
            $table->decimal('litres', 10, 2);
            $table->string('status');
            $table->unsignedBigInteger('fuel_id');
            $table->timestamps(); 
            $table->softDeletes();

            $table->foreign('fuel_id')->references('id')->on('fuels')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dips');
    }
};
