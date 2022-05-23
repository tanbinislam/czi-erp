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
        Schema::create('made_recipe_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_product_id');
            $table->string('quantity')->nullable();
            $table->string('price');
            $table->unsignedBigInteger('recipe_id');
            $table->date('date');
            $table->string('slug', 50);
            $table->boolean('status')->default(1);
            // $table->foreign('recipe_id')->on('recipes')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('made_recipe_products');
    }
};
