<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model')->nullable();
            $table->decimal('last_reading', 10, 2)->nullable();
            $table->decimal('liters', 18, 2);
            $table->unsignedBigInteger('fuel_id')->nullable(); 
            $table->unsignedBigInteger('fuel_type_id')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes(); 

            // Foreign key constraint
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('cascade');
            $table->foreign('fuel_id')->references('id')->on('fuels')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('machines');
    }
};
