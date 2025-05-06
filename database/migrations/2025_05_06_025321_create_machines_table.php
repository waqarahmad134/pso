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
            $table->decimal('last_reading', 10, 2)->nullable(); // NEW COLUMN
            $table->unsignedBigInteger('fuel_type_id');
            $table->string('status')->default('active'); // e.g., active/inactive
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('machines');
    }
};
