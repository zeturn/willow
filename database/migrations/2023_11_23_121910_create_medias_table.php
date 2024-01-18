<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    public function up(): void
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url');
            $table->integer('status');
            $table->uuid('user_id');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes(); // 如果您计划使用软删除

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
}
