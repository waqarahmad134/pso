<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilOilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobil_oils', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the Mobil Oil
            $table->decimal('saleprice', 10, 2); // Sale price of the oil
            $table->integer('inventory'); // Inventory count
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil_oils');
    }
}
