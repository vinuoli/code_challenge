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
        Schema::create('registereds', function (Blueprint $table) {
            $table->id('registered_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->float('net_income');
            $table->float('requested_amount');
            $table->timestamp('registration')->nullable();
            $table->time('initial_communication_time', $precision = 0);
            $table->time('end_communication_time', $precision = 0);
            $table->integer('id_expert_assigned')->default(0)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registereds');
    }
};
