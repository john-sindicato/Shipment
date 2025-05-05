<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('teller', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->date('dob');
            $table->string('gender');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('street');
            $table->string('brgy');
            $table->string('city');
            $table->string('province');
            $table->integer('zipcode');
            $table->string('branch');
            $table->string('profile')->nullable();
            $table->string('password');
            $table->enum('status', ['active', 'deleted'])->default('active'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teller');
    }
};
