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
        Schema::create('zonal_reports', function (Blueprint $table) {
            $table->id();
            $table->string('zone_id');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->string('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->string('report_month');
            $table->string('report_year');
            $table->integer('month_key', false, false);
            $table->string('branch_visited');
            $table->string('pastor_follow_teaching');
            $table->decimal('total_first_offering');
            $table->decimal('total_tithe');
            $table->string('check_amalgamation');
            $table->decimal('amalgamation_paid');
            $table->string('algamation_correct');
            $table->string('attendance_inc_dec');
            $table->string('attendance_verified');
            $table->string('records_verified');
            $table->string('pastor_corporate');
            $table->text('zonal_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonal_reports');
    }
};
