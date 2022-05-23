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
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payable_amount')->nullable();
            $table->unsignedBigInteger('customer_id');
            // $table->foreign('customer_id')->on('customers')->references('customer_id')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->timestamps();
            $table->string('date', 121)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_payments');
    }
};
