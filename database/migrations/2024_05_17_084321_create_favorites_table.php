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
        Schema::create('favorites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable(); // 收藏夹名称
            $stale->text('description')->nullable(); // 收藏夹描述
            $table->json('favorites')->nullable(); // 存储收藏内容的JSON数组
            $table->string('status')->default('5'); // 收藏夹状态，默认为公开
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
