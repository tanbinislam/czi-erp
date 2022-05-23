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
        Schema::create('material_recipes', function (Blueprint $table) {
            $table->bigIncrements('recipe_id');
            $table->string('recipe_name')->unique();
            $table->text('recipe_remarks')->nullable();
            $table->integer('recipe_creator')->nullable();
            $table->string('recipe_slug')->nullable();
            $table->string('recipe_status')->default(1);
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
        Schema::dropIfExists('material_recipes');
    }
};
