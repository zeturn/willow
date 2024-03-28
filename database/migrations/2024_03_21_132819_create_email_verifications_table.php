<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // 将 'id' 改为 'Id'
            $table->uuid('user_id');
            $table->string('verification_key')->nullable();//验证密钥
            $table->integer('verification_type')->default(0);//验证类型
            $table->integer('action_type')->default(0);//动作类型 0.注册 1.修改邮箱
            $table->timestamps();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('expires_at')->nullable();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_verifications');
    }
};
