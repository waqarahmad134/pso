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
        Schema::create('stock_testings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fuel_id');
            $table->unsignedBigInteger('machine_id');
            $table->decimal('litres', 10, 2);
            $table->boolean('adjustment')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fuel_id')->references('id')->on('fuels')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_testings');
    }
};
