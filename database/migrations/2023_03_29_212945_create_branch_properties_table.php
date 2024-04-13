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
        Schema::create('branch_properties', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->cascadeOnDelete();
            $table->string('pastor_name');
            $table->string('meeting_place');
            $table->string('own_land');
            $table->string('other_lands')->nullable();
            $table->string('available_doc');
            $table->string('registration_stage');
            $table->string('document_location');
            $table->string('remarks')->nullable();
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->timestamps();
            //pastor_name.meeting_place|own_land|other_lands|available_doc|registration_stage|document_location|remarks|photo1|photo2
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_properties');
    }
};
