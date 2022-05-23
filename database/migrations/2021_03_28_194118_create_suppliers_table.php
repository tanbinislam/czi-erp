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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('supplier_id');
            $table->string('supplier_name',50)->nullable();
            $table->string('supplier_company',150)->nullable();
            $table->string('supplier_phone',20)->unique();
            $table->string('supplier_email',50)->nullable();
            $table->text('supplier_address')->nullable();
            $table->string('supplier_website',50)->nullable();
            $table->string('supplier_photo',50)->nullable();
            $table->unsignedDouble('previous_due_amount',20,2)->default(0.00);
            $table->integer('supplier_creator')->nullable();
            $table->string('supplier_slug',50)->nullable();
            $table->integer('supplier_status')->default(1);
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
        Schema::dropIfExists('suppliers');
    }
};
