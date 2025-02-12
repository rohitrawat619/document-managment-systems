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
    Schema::table('roles', function (Blueprint $table) {
        // Check if the column already exists to avoid duplication
        if (!Schema::hasColumn('roles', 'permission_id')) {
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
        }
     });
    }
    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop the foreign key and column when rolling back
            $table->dropForeign(['permission_id']);
            $table->dropColumn('permission_id');
        });
    }
};
