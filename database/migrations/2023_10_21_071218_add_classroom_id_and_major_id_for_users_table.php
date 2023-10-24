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
        Schema::table('users', function(Blueprint $table) {
            $table->foreignId('classroom_id')->nullable()->after('uuid');
            $table->foreignId('major_id')->nullable()->after('uuid');

            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->foreign('major_id')->references('id')->on('majors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['users_classroom_id_foreign', 'users_major_id_foreign']);
        });
    }
};
