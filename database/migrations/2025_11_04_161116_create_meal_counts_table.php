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
        Schema::create('meal_counts', function (Blueprint $table) {
            $table->bigInteger('meal_id');
            $table->bigInteger('user_id');
            $table->integer('d_1')->default(0);
            $table->integer('d_2')->default(0);
            $table->integer('d_3')->default(0);
            $table->integer('d_4')->default(0);
            $table->integer('d_5')->default(0);
            $table->integer('d_6')->default(0);
            $table->integer('d_7')->default(0);
            $table->integer('d_8')->default(0);
            $table->integer('d_9')->default(0);
            $table->integer('d_10')->default(0);
            $table->integer('d_11')->default(0);
            $table->integer('d_12')->default(0);
            $table->integer('d_13')->default(0);
            $table->integer('d_14')->default(0);
            $table->integer('d_15')->default(0);
            $table->integer('d_16')->default(0);
            $table->integer('d_17')->default(0);
            $table->integer('d_18')->default(0);
            $table->integer('d_19')->default(0);
            $table->integer('d_20')->default(0);
            $table->integer('d_21')->default(0);
            $table->integer('d_22')->default(0);
            $table->integer('d_23')->default(0);
            $table->integer('d_24')->default(0);
            $table->integer('d_25')->default(0);
            $table->integer('d_26')->default(0);
            $table->integer('d_27')->default(0);
            $table->integer('d_28')->default(0);
            $table->integer('d_29')->default(0);
            $table->integer('d_30')->default(0);
            $table->integer('d_31')->default(0);
            $table->timestamps();
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['meal_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_counts');
    }
};
