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
        Schema::create('branch_targets', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->integer('attendance');
            $table->decimal('income');
            $table->string('attendance_criteria');
            $table->string('income_criteria');
            $table->integer('target_year');
            $table->string('maker_id',10);
            $table->timestamps();

        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_targets');
    }
};
