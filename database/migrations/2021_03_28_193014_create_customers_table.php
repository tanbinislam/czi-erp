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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('customer_name',50)->nullable();
            $table->string('customer_company',150)->nullable();
            $table->string('customer_phone',20)->unique();
            $table->string('customer_email',50)->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_website',50)->nullable();
            $table->string('customer_photo',50)->nullable();
            $table->unsignedDouble('previous_due_amount',20,2)->default(0.00);
            $table->integer('customer_creator')->nullable();
            $table->string('customer_slug',50)->nullable();
            $table->integer('customer_status')->default(1);
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
        Schema::dropIfExists('customers');
    }
};
