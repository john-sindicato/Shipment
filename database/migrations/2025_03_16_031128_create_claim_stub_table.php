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
        Schema::create('claim_stub', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone');
            $table->string('email');
            $table->string('expected_delivery_date');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status', ['new', 'read', 'deleted'])->default('new');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claim_stub');
    }
};
