<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
       public function up()
        {
            Schema::table('student_preferences', function (Blueprint $table) {
                $table->string('course_title')->nullable();
                $table->integer('credit_hours')->nullable();
            });
        }
    /**
     * Reverse the migrations.
     */
      public function down()
        {
            Schema::table('student_preferences', function (Blueprint $table) {
                $table->dropColumn(['course_title', 'credit_hours']);
            });
        }

};


