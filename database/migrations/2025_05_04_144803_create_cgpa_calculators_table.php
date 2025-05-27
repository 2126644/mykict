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
        Schema::create('cgpa_calculators', function (Blueprint $table) {
            $table->id('calculation_id');
            $table->unsignedInteger('matric_no'); // no ->foreign()
            $table->string('course_code');        // no ->foreign()
            $table->string('grade', 2);       //e.g., 'A', 'B+'
            $table->integer('semester');
            $table->integer('credit_completed');
            $table->decimal('current_cgpa', 4, 2);
            $table->decimal('new_gpa', 4, 2)->nullable();
            $table->decimal('new_cgpa', 4, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cgpa_calculators');
    }
};


