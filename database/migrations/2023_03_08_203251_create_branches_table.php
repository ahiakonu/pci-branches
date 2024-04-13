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
        Schema::create('branches', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('church_name')->unique();
            $table->string('church_location');
            $table->string('church_email')->unique();
            $table->string('church_address')->nullable();
            $table->string('division_id');
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('zone_id');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->string('currency');
            $table->string('city');
            $table->string('year_established');
            $table->string('website')->nullable();
            $table->string('church_status');
            /*  $table->string('property_type'); */
            $table->string('g_lat')->nullable();
            $table->string('g_long')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
