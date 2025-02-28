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
        Schema::create('minutes_of_metting', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('division_id')->index()->nullable();
            $table->date('date_of_Meeting')->nullable();
            $table->string('subject',255)->nullable();
            $table->string('agenda',200)->nullable();
            $table->string('issuer_designation',200)->nullable();
            $table->bigInteger('uploaded_by')->index()->nullable();
            $table->string('keyword',200)->nullable();
            $table->dateTime('date_of_upload')->nullable();
            $table->tinyInteger('is_active')->default(1)->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->bigInteger('deleted_by')->index()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->unsignedBigInteger('user_id')->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Optional: Define behavior on delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minutes_of_metting');
    }
};
