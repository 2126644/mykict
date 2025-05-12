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
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedInteger('matric_no')->primary();
            $table->string('st_name');
            $table->string('st_email')->unique();
            $table->string('st_password');
            //$table->string('column') → means VARCHAR(255)
            //$table->string('column', 100) → means VARCHAR(100)
            $table->integer('year');
            $table->integer('sem');
            $table->string('major');
            $table->string('specialization');
            $table->decimal('current_cgpa', 4, 2)->nullable();
            $table->decimal('target_cgpa', 4, 2)->nullable();

            // GPA & CGPA Sem 1–8
            for ($i = 1; $i <= 8; $i++) {
                $table->decimal("gpa_sem{$i}", 4, 2)->nullable();
                $table->decimal("cgpa_sem{$i}", 4, 2)->nullable();
            }

            $table->timestamps(); // for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
