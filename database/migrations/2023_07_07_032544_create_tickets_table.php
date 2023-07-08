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
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package_code');
            $table->foreign('package_code')->references('package_code')->on('ticket_packages'); // ->onDelete('cascade')->onUpdate('cascade');
            $table->string('ticket_code');
            $table->string('event_name');
            $table->string('usage_status');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('check_in_gate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
