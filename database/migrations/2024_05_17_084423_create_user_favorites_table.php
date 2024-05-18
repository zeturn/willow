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
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained('users'); // 使用foreignUuid来匹配users表中的uuid类型
            $table->foreignUuid('favorite_id')->constrained('favorites'); // 外键约束，关联收藏夹表
            $table->string('permission_type')->nullable(); // 权限类型
            $table->string('status')->default('5'); // 收藏夹状态，默认为公开
            $table->primary(['user_id', 'favorites_id']); // 设置复合主键
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_favorites');
    }
};
