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
        Schema::create('student_preferences', function (Blueprint $table) {
            $table->id('preference_id');
             $table->unsignedInteger('matric_no');
             $table->string('course_code');
             $table->string('course_title');
             $table->integer('credit_hrs');

            //enum for action (add/drop)
            $table->enum('action', ['add', 'drop']);
            //allows a field to have only one value from a predefined set of values

             /*Foreign key constraints
             $table->foreign('matric_no')
                 ->references('matric_no')
                 ->on('students')
                 ->onDelete('cascade');

             $table->foreign('course_code')
                 ->references('course_code')
                 ->on('courses')
                 ->onDelete('cascade'); */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_preferences');
    }
};
