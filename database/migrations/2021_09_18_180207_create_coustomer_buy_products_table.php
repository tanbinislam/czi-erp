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
        Schema::create('coustomer_buy_products', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('quantity');
            $table->unsignedBigInteger('customer_id');
            // $table->foreign('customer_id')->on('customers')->references('customer_id')->onDelete('cascade');
            $table->unsignedBigInteger('recipe_product_id');
            $table->timestamp('purchase_date');
            // $table->foreign('made_recipe_product_id')->on('made_recipe_products')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coustomer_buy_products');
    }
};
