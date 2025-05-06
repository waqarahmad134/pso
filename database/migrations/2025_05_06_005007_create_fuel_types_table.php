<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up()
    {
        Schema::create('fuel_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status')->default('active'); // e.g., active/inactive
            $table->decimal('price', 10, 2); // New price column (10 digits, 2 decimals)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuel_types');
    }
};