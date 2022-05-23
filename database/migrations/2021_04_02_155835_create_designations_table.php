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
        Schema::create('designations', function (Blueprint $table) {
          $table->bigIncrements('designation_id');
          $table->string('designation_name')->unique();
          $table->text('designation_remarks')->nullable();
          $table->integer('designation_creator')->nullable();
          $table->string('designation_slug')->nullable();
          $table->string('designation_status')->default(1);
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
        Schema::dropIfExists('designations');
    }
};
