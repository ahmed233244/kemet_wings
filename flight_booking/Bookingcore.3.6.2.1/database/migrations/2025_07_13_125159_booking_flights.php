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
       Schema::create('booking_flights', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('booking_id');
    $table->unsignedBigInteger('flight_id');
    $table->unsignedBigInteger('fare_id');
    $table->integer('segment_number');
    $table->string('adult_price');
    $table->string('child_price');
    $table->string('infant_price');
    $table->timestamps();

    $table->foreign('booking_id')->references('id')->on('bravo_bookings')->onDelete('cascade');
    $table->foreign('fare_id')->references('id')->on('bravo_flight_seat')->onDelete('cascade');
    $table->foreign('flight_id')->references('id')->on('bravo_flight')->onDelete('cascade');
    // Add more fields as needed (seat type, price at booking, etc.)
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
