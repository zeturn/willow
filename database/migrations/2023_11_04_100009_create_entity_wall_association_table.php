<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_wall_association', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('entity_type');
            $table->uuid('entity_id');
            $table->foreignUuid('wall_id')->references('id')->on('walls')->onDelete('cascade');            
            $table->integer('status'); 
            $table->timestamps();

            // 如果你需要对entity进行外键约束，你可能需要为每种entity类型创建单独的外键
            // 由于这种多态关系通常不需要严格的外键约束，以下代码被注释
            // $table->foreign('entity_id')->references('id')->on('entries')->onDelete('cascade');
            // $table->foreign('entity_id')->references('id')->on('branches')->onDelete('cascade');
            // $table->foreign('entity_id')->references('id')->on('versions')->onDelete('cascade');

            // 创建一个复合索引，可以根据需要调整
            $table->index(['entity_type', 'entity_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_wall_association');
    }
};
