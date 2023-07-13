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
        Schema::create('ticket_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package_code')->unique();
            $table->string('package_name');
            $table->string('event_name')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->bigInteger('ticket_price')->nullable();
            $table->bigInteger('combo_price_amount')->nullable();
            $table->bigInteger('combo_price_tickets')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_packages');
    }
};
