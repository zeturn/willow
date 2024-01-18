<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsEntryAssociationTable extends Migration
{
    public function up()
    {
        Schema::create('albums_entry_association', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('album_id');
            $table->uuid('entity_id');
            $table->string('entity_type');
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('albums_entry_association');
    }
}
