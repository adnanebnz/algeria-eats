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
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table
                ->foreign('user_id')
                ->on('users')
                ->references('id');

            $table->unsignedBigInteger('reviewer_id');
            $table
                ->foreign('reviewer_id')
                ->on('users')
                ->references('id');

            $table->text('review');
            $table->unsignedTinyInteger('rating');
            $table
                ->enum('status', ['pending', 'accepted'])
                ->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reviews');
    }
};
