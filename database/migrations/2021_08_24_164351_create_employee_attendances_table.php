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
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('intime')->nullable();
            $table->time('outtime')->nullable();
            $table->integer('overtime')->default(0);
            $table->boolean('is_holiday')->default(0);
            $table->boolean('status')->default(1);
            $table->bigInteger('employee_id');
            $table->bigInteger('shift_id');
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
        Schema::dropIfExists('employee_attendances');
    }
};
