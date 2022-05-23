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
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('material_id');
            $table->string('material_name',100)->unique();
            $table->text('material_remarks')->nullable();
            $table->string('material_photo',50)->nullable();
            $table->integer('material_creator')->nullable();
            $table->string('material_slug',100)->nullable();
            $table->integer('material_status')->default(1);
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
        Schema::dropIfExists('materials');
    }
};
