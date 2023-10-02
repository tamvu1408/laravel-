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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->integer('department_id')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('gender')->nullable();
            $table->date('starting_date')->nullable();
            $table->integer('role')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('department_id');
            $table->dropColumn('birth_date');
            $table->dropColumn('gender');
            $table->dropColumn('starting_date');
            $table->dropColumn('role');
            $table->dropColumn('status');
        });
    }
};
