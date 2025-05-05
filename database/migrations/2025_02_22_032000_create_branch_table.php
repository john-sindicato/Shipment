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
        Schema::create('branch', function (Blueprint $table) {
            $table->id();
            $table->string('province');
            $table->string('address');
            $table->string('contact_person');  
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->enum('status', ['open', 'close', 'deleted'])->default('open');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};
