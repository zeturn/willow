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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('topic_id')->constrained('topics');
            $table->foreignUuid('user_id')->constrained('users');
            $table->text('content');
            $table->integer('status');
            $table->uuid('parent_id')->nullable();// 合并 parent_id 的定义和外键约束    
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
