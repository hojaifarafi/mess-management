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
            $table->integer('sl_no')->autoIncrement();
            $table->bigInteger('meal_id');
            $table->bigInteger('user_id');
            $table->string('short_name');
            $table->decimal('d_1', 5, 2)->default(0);
            $table->decimal('d_2', 5, 2)->default(0);
            $table->decimal('d_3', 5, 2)->default(0);
            $table->decimal('d_4', 5, 2)->default(0);
            $table->decimal('d_5', 5, 2)->default(0);
            $table->decimal('d_6', 5, 2)->default(0);
            $table->decimal('d_7', 5, 2)->default(0);
            $table->decimal('d_8', 5, 2)->default(0);
            $table->decimal('d_9', 5, 2)->default(0);
            $table->decimal('d_10', 5, 2)->default(0);
            $table->decimal('d_11', 5, 2)->default(0);
            $table->decimal('d_12', 5, 2)->default(0);
            $table->decimal('d_13', 5, 2)->default(0);
            $table->decimal('d_14', 5, 2)->default(0);
            $table->decimal('d_15', 5, 2)->default(0);
            $table->decimal('d_16', 5, 2)->default(0);
            $table->decimal('d_17', 5, 2)->default(0);
            $table->decimal('d_18', 5, 2)->default(0);
            $table->decimal('d_19', 5, 2)->default(0);
            $table->decimal('d_20', 5, 2)->default(0);
            $table->decimal('d_21', 5, 2)->default(0);
            $table->decimal('d_22', 5, 2)->default(0);
            $table->decimal('d_23', 5, 2)->default(0);
            $table->decimal('d_24', 5, 2)->default(0);
            $table->decimal('d_25', 5, 2)->default(0);
            $table->decimal('d_26', 5, 2)->default(0);
            $table->decimal('d_27', 5, 2)->default(0);
            $table->decimal('d_28', 5, 2)->default(0);
            $table->decimal('d_29', 5, 2)->default(0);
            $table->decimal('d_30', 5, 2)->default(0);
            $table->decimal('d_31', 5, 2)->default(0);
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
