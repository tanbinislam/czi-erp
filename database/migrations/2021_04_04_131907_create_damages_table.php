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
        Schema::create('damages', function (Blueprint $table) {
            $table->bigIncrements('damage_id');
            $table->integer('material_id');
            $table->string('mp_chalan',20);
            $table->text('damage_remarks')->nullable();
            $table->string('damage_quantity',20)->nullable();
            $table->integer('damage_creator')->nullable();
            $table->string('damage_slug')->nullable();
            $table->string('damage_status')->default(1);
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
        Schema::dropIfExists('damages');
    }
};
