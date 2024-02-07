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
        Schema::create('entry_branches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->uuid('entry_id');
            $table->uuid('demo_version_id')->nullable();
            $table->boolean('is_pb');
            $table->boolean('is_free');
            $table->json('log')->nullable();
            $table->integer('status');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_branches');
    }
};
