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
        Schema::create('shift_data', function (Blueprint $table) {
            $table->id();
            $table->date('shift_date');
            $table->enum('shift_type', ['morning', 'night']);
            $table->unsignedBigInteger('cashier_id');
            $table->unsignedBigInteger('dip_petrol_id');
            $table->unsignedBigInteger('dip_diesel_id');
            $table->decimal('petrol_price', 8, 2);
            $table->decimal('diesel_price', 8, 2);
            $table->decimal('cash_in_hand', 12, 2)->default(0);
            $table->decimal('bank_online', 12, 2)->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dip_petrol_id')->references('id')->on('dips')->onDelete('cascade');
            $table->foreign('dip_diesel_id')->references('id')->on('dips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_data');
    }
};
