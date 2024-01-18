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
        Schema::create('entry_branch_users', function (Blueprint $table) {
            $table->uuid('id')->primary(); // 将 'id' 改为 'Id'
            $table->uuid('entry_branch_id'); // 
            $table->integer('role'); // 将 'role' 改为 'Role'
            $table->uuid('user_id'); // 用户id
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_branch_users');
    }
};
