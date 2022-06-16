<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_author');
            $table->unsignedBigInteger('id_category');
            $table->string('title');
            $table->string('title_en');
            $table->string('judul');
            $table->string('judul_en');
            $table->string('content');
            $table->string('content_en');
            $table->string('image');
            $table->string('view');
            $table->string('tag');
            $table->timestamps();
 
            $table->foreign('id_author')->references('id')->on('users');
            $table->foreign('id_category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
