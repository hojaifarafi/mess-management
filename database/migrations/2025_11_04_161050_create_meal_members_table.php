<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meal_members', function (Blueprint $table) {
            $table->integer('sl_no')->autoIncrement();
            $table->bigInteger('meal_id');
            $table->bigInteger('user_id');
            $table->string('short_name');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['meal_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_members');
    }
};
