<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('submitted_request', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('street')->nullable();
            $table->string('brgy')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('region')->nullable();
            $table->string('origin');
            $table->string('destination');
            $table->string('category')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_request');
    }
};
