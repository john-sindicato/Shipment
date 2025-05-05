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
        Schema::create('dispatched_shipment', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone');
            $table->string('email');
            $table->string('street');
            $table->string('brgy');
            $table->string('city');
            $table->string('province');
            $table->string('zipcode');
            $table->string('region');
            $table->string('origin');
            $table->string('destination');
            $table->string('category');
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->string('weight');
            $table->string('dispatch_date');
            $table->timestamp('arrival_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatched_shipment');
    }
};
