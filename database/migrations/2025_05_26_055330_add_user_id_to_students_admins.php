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
        // Update students table
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Link student to users
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        // Update admins table
        Schema::table('admins', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Link admin to users
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes in students table
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        // Revert changes in admins table
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};


