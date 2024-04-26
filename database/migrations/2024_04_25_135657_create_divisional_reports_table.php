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
        Schema::create('divisional_reports', function (Blueprint $table) {
            $table->id();
            $table->string('division_id');
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('report_year');
            $table->string('report_month');
            $table->integer('month_key', false, false);
            $table->string('visit_any_branch');
            $table->string('branches_visisted');
            $table->string('branches_paid_amalg');
            $table->string('branches_not_paid_amalg_details')->nullable();
            $table->string('sent_amalg');
            $table->string('not_sent_amalg_details')->nullable();
            $table->string('amalg_defaults');
            $table->string('amalg_defaults_branches')->nullable();
            $table->string('amalg_defaults_action')->nullable();
            $table->string('compliance_issues');
            $table->string('compliance_issues_details')->nullable();
            $table->string('divisional_programs');
            $table->string('divisional_ptogram_details')->nullable();
            $table->string('all_branches_attended')->nullable();
            $table->string('all_branches_attended_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisional_reports');
    }
};
