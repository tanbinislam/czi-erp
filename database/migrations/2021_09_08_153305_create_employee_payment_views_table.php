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
        Schema::create('employee_payment_views', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->nullable();
            $table->string('total_salary')->nullable();
            $table->string('month')->nullable();
            $table->date('ds_date')->nullable();
            $table->string('bonus')->nullable();
            $table->unsignedDouble('overtime_salary', 20, 2)->default(0.00);
            $table->string('working_hour')->nullable();
            $table->string('working_period')->nullable();
            $table->tinyInteger('payment_type')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_pay')->default(0);
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('employee_payment_views');
    }
};
