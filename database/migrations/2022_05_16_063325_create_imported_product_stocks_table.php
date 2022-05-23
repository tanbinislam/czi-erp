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
        Schema::create('imported_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imported_product_id');
            $table->date('purchase_date');
            $table->unsignedDouble('purchase_quantity',20,2)->nullable();
            $table->unsignedDouble('purchase_unit_price', 20,2)->nullable();
            $table->unsignedDouble('purchase_total_price', 20,2)->nullable();
            $table->string('purchase_chalan')->nullable();
            $table->string('purchase_voucher')->nullable();
            $table->integer('purchase_creator')->nullable();
            $table->string('purchase_slug')->nullable();
            $table->integer('purchase_status')->default(1);
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
        Schema::dropIfExists('imported_product_stocks');
    }
};
