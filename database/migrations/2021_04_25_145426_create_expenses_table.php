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
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('expens_id');
            $table->integer('exp_cat_id');
            $table->string('expens_amount',20)->nullable();
            $table->text('expens_details')->nullable();
            $table->date('expens_date');
            $table->integer('expens_creator')->nullable();
            $table->string('expens_slug')->nullable();
            $table->string('expens_status')->default(1);
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
        Schema::dropIfExists('expenses');
    }
};
