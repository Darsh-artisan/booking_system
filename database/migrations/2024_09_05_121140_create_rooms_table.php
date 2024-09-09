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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_no');
            $table->enum('room_type', ['Deluxe', 'Luxury', 'Royal']);
            $table->boolean('bathtub')->default(false);
            $table->boolean('balcony')->default(false);
            $table->boolean('mini_bar')->default(false);
            $table->decimal('rate_per_day',  8, 2)->default(0.00);
            $table->unsignedInteger('max_occupancy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
