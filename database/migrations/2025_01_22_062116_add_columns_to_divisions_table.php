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
        Schema::table('divisions', function (Blueprint $table) {
            $table->string('unique_key', 150)->nullable();
            $table->tinyInteger('is_active')->default(1)->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->bigInteger('deleted_by')->index()->nullable();
            $table->dateTime('deleted_at')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('divisions', function (Blueprint $table) {
            //
        });
    }
};
