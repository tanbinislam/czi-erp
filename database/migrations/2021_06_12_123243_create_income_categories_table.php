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
        Schema::create('income_categories', function (Blueprint $table) {
          $table->bigIncrements('in_cat_id');
          $table->string('in_cat_name')->unique();
          $table->text('in_cat_remarks')->nullable();
          $table->integer('in_cat_creator')->nullable();
          $table->string('in_cat_slug')->nullable();
          $table->string('in_cat_status')->default(1);
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
        Schema::dropIfExists('income_categories');
    }
};
