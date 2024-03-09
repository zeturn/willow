<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::create('entry_version_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('entry_id');   
            $table->uuid('branch_id')->nullable();
            $table->uuid('version_id')->nullable();//对应version（如果有）           
            $table->uuid('original_version_id')->nullable();   
            $table->uuid('new_version_id')->nullable();  
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('content');
            $table->uuid('author_id');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();

            /**
             * ------------------------
             * Status
             * ------------------------
             * 
             * 1.
             * 2.
             * 3.
             * 4.
             * 5.entry有值 branch有值 创建新的特定词条下面的公共分支下面的版本
             * 6.entry有值 branch有值 创建新的特定词条下面的特定分支下面的版本
             * 7.entry有值 branch无值 创建新的特定词条下面的新的分支与版本
             * 8.
             * 9.
             * 10.
             * ...
             * 15. 5已经处理
             * 16. 6已经处理
             * 17. 7已经处理
             * 
             * 
             */
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_version_tasks');
    }
};
