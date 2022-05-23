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
        Schema::create('incomes', function (Blueprint $table) {
            $table->bigIncrements('income_id');
            $table->integer('in_cat_id');
            $table->string('income_amount',20)->nullable();
            $table->text('income_details')->nullable();
            $table->date('income_date');
            $table->integer('income_creator')->nullable();
            $table->string('income_slug')->nullable();
            $table->string('income_status')->default(1);
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
        Schema::dropIfExists('incomes');
    }
};
