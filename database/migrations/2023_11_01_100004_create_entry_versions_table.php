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
        Schema::create('entry_versions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('entry_branch_id');
            $table->string('name');
            $table->text('description');
            $table->text('content');
            $table->uuid('author_id');
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
        Schema::dropIfExists('entry_versions');
    }
};
