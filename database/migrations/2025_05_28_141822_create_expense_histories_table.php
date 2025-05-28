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
        Schema::create('expense_histories', function (Blueprint $table) {
            $table->id();
            $table->string('expense_name');
            $table->decimal('amount', 10, 2);
            $table->text('details')->nullable();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shift_data_id');
            $table->timestamps();
            $table->softDeletes();

            // Optional foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shift_data_id')->references('id')->on('shift_data')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_histories');
    }
};
