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
        Schema::create('material_purchases', function (Blueprint $table) {
            $table->bigIncrements('mp_id');
            $table->integer('material_id');
            $table->date('mp_date');
            $table->unsignedDouble('mp_quantity',20,2)->nullable();
            $table->unsignedDouble('mp_unit_price', 20,2)->nullable();
            $table->unsignedDouble('mp_total_price', 20,2)->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('mp_chalan')->nullable();
            $table->string('mp_voucher')->nullable();
            $table->integer('mp_creator')->nullable();
            $table->string('mp_slug')->nullable();
            $table->integer('mp_status')->default(1);
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
        Schema::dropIfExists('material_purchases');
    }
};
