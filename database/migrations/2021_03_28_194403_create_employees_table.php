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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('employee_id');
            $table->string('employee_name',50)->nullable();
            $table->string('employee_phone',20)->unique();
            $table->string('employee_father',50)->unique();
            $table->string('employee_mother',50)->unique();
            $table->string('employee_email',50)->nullable();
            $table->string('employee_dob',50)->nullable();
            $table->string('employee_nid',50)->nullable();
            $table->foreignId('designation_id')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->string('employee_maritial', 20)->nullable();
            $table->string('blood_id',50)->nullable();
            $table->text('employee_address')->nullable();
            $table->string('employee_photo',50)->nullable();
            $table->string('employee_code',50)->unique();
            $table->integer('employee_creator')->nullable();
            $table->string('employee_slug',50)->nullable();
            $table->integer('employee_status')->default(1);
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
        Schema::dropIfExists('employees');
    }
};
