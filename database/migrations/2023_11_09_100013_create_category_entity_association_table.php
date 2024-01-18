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
        Schema::create('category_entity_association', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('category_type');
            $table->uuid('category_id');
            $table->string('entity_type');
            $table->uuid('entity_id');
            $table->string('relationship_type');
            $table->integer('status'); 
            $table->timestamps();
            $table->softDeletes();

            // 可以根据需要添加外键约束
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_entity_association');
    }
};
