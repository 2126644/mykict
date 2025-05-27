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
        Schema::table('students', function (Blueprint $table) {
            $table->decimal('target_cgpa', 4, 2)->nullable();

            // GPA and CGPA for each semester
            $table->decimal('gpa_sem1', 4, 2)->nullable();
            $table->decimal('cgpa_sem1', 4, 2)->nullable();

            $table->decimal('gpa_sem2', 4, 2)->nullable();
            $table->decimal('cgpa_sem2', 4, 2)->nullable();

            $table->decimal('gpa_sem3', 4, 2)->nullable();
            $table->decimal('cgpa_sem3', 4, 2)->nullable();

            $table->decimal('gpa_sem4', 4, 2)->nullable();
            $table->decimal('cgpa_sem4', 4, 2)->nullable();

            $table->decimal('gpa_sem5', 4, 2)->nullable();
            $table->decimal('cgpa_sem5', 4, 2)->nullable();

            $table->decimal('gpa_sem6', 4, 2)->nullable();
            $table->decimal('cgpa_sem6', 4, 2)->nullable();

            $table->decimal('gpa_sem7', 4, 2)->nullable();
            $table->decimal('cgpa_sem7', 4, 2)->nullable();

            $table->decimal('gpa_sem8', 4, 2)->nullable();
            $table->decimal('cgpa_sem8', 4, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->decimal('target_cgpa', 4, 2)->nullable();

            // GPA and CGPA for each semester
            $table->decimal('gpa_sem1', 4, 2)->nullable();
            $table->decimal('cgpa_sem1', 4, 2)->nullable();

            $table->decimal('gpa_sem2', 4, 2)->nullable();
            $table->decimal('cgpa_sem2', 4, 2)->nullable();

            $table->decimal('gpa_sem3', 4, 2)->nullable();
            $table->decimal('cgpa_sem3', 4, 2)->nullable();

            $table->decimal('gpa_sem4', 4, 2)->nullable();
            $table->decimal('cgpa_sem4', 4, 2)->nullable();

            $table->decimal('gpa_sem5', 4, 2)->nullable();
            $table->decimal('cgpa_sem5', 4, 2)->nullable();

            $table->decimal('gpa_sem6', 4, 2)->nullable();
            $table->decimal('cgpa_sem6', 4, 2)->nullable();

            $table->decimal('gpa_sem7', 4, 2)->nullable();
            $table->decimal('cgpa_sem7', 4, 2)->nullable();

            $table->decimal('gpa_sem8', 4, 2)->nullable();
            $table->decimal('cgpa_sem8', 4, 2)->nullable();
    });
}
};
