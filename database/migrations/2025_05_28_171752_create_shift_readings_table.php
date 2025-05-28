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
        Schema::create('shift_readings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shift_data_id');
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->unsignedBigInteger('mobil_id')->nullable();
            $table->decimal('last_reading', 10, 2)->nullable();
            $table->decimal('today_reading', 10, 2)->nullable();
            $table->decimal('litres', 10, 2)->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shift_data_id')->references('id')->on('shift_data')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('set null');
            $table->foreign('mobil_id')->references('id')->on('mobil_oils')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_readings');
    }
};
