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
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status')->default('active'); // e.g., active/inactive
            $table->decimal('price', 18, 2);
            $table->decimal('liters', 18, 2);
            $table->unsignedBigInteger('fuel_type_id'); // Foreign key reference to fuel_types table
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuels');
    }
};
