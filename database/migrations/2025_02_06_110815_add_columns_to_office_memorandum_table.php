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
        Schema::table('office_memorandum', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->default(null);

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade'); // Optional: Define behavior on delete

      // Ensure that user_id is unique for one-to-one relationship
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_memorandum', function (Blueprint $table) {
            //
        });
    }
};
