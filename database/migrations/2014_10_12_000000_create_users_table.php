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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key',150)->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_name',150);
            $table->string('password');
            $table->bigInteger('role_id')->index()->nullable();
            $table->string('designation')->index()->nullable();
            $table->string('division')->index()->nullable();
            $table->string('phone',100)->nullable();
            $table->string('phone_code',50)->nullable();
            $table->string('phone_iso',50)->nullable();
            $table->tinyInteger('is_active')->default(1)->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->bigInteger('deleted_by')->index()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
