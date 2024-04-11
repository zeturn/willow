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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->string('real_name')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('signature')->nullable();
            $table->json('links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
