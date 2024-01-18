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
        Schema::create('edges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('start_node');
            $table->foreign('start_node')->references('id')->on('nodes')->onDelete('cascade');
            $table->uuid('end_node');
            $table->foreign('end_node')->references('id')->on('nodes')->onDelete('cascade');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edges');
    }
};
