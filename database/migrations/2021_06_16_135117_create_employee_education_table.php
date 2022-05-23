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
        Schema::create('employee_education', function (Blueprint $table) {
            $table->bigIncrements('empedu_id');
            $table->integer('employee_id');
            $table->string('empedu_title',100)->nullable();
            $table->string('empedu_institute',100)->nullable();
            $table->string('empedu_year',20)->nullable();
            $table->string('empedu_result',50)->nullable();
            $table->string('empedu_remarks',150)->nullable();
            $table->integer('empedu_creator')->nullable();
            $table->string('empedu_slug')->nullable();
            $table->integer('empedu_status')->default(1);
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
        Schema::dropIfExists('employee_education');
    }
};
