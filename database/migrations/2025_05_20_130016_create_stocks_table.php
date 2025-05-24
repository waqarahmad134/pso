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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('stock_type'); // Change to string (NOT enum)
            $table->unsignedBigInteger('stock_item_id');       
            $table->unsignedBigInteger('supplier_id');         
            $table->float('quantity');
            $table->decimal('sale_price', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('remaining_amount', 10, 2);
            $table->timestamps();
            $table->softDeletes(); 


            $table->foreign('supplier_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
