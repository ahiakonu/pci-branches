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
        Schema::create('branch_reports', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->date('service_date');
            $table->string('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->string('name_of_preacher');
            $table->string('theme_and_sermon');
            $table->decimal('amalgamation');
            $table->decimal('amalgamation_paid');
            $table->decimal('tithe');
            $table->decimal('first_offering');
            $table->decimal('second_offering');
            $table->decimal('thanksgiving');
            $table->decimal('special_offering');
            $table->string('other_donations_cash_or_kind')->nullable();
            $table->integer('female', false, false);
            $table->integer('male', false, false);
            $table->integer('children', false, false);
            $table->integer('visitors', false, false);
            $table->integer('souls_won', false, false);
            $table->integer('water_baptised', false, false);
            $table->integer('holy_ghost_baptised', false, false);
            $table->integer('people_inducted', false, false);
            $table->integer('weddings', false, false);
            $table->integer('births', false, false);
            $table->integer('children_named', false, false);
            $table->integer('children_dedicated', false, false);
            $table->integer('deaths', false, false);
            $table->string('special_programs_in_week')->nullable();
            $table->string('issues_or_comments')->nullable();
            $table->string('report_by'); //cells.cells_met.avg_cell_attendance.cell_offering
            $table->integer('cells');
            $table->integer('cells_met', false, false);
            $table->integer('avg_cell_attendance');
            $table->string('cell_offering');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_reports');
    }
};
