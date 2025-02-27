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
        Schema::create('gazette_notification', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('division_id')->index()->nullable();
            $table->string('notification_no',255)->nullable();
            $table->string('title',255)->nullable();
            $table->date('date_of_notification')->nullable();
            $table->string('issuer_name',200)->nullable();
            $table->string('issuer_designation',200)->nullable();
            $table->bigInteger('uploaded_by')->index()->nullable();
            $table->string('keyword',200)->nullable();
            $table->dateTime('date_of_upload')->nullable();
            $table->tinyInteger('is_active')->default(1)->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->bigInteger('deleted_by')->index()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->unsignedBigInteger('user_id')->default(null);
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gazette_notification');
    }
};
