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
        Schema::table('bravo_booking_passengers', function (Blueprint $table) {
        $table->string('passport')->nullable();
        $table->string('nationality')->nullable();
        $table->string('date_of_birth')->nullable();
        $table->string('title')->nullable(); // Add column
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
