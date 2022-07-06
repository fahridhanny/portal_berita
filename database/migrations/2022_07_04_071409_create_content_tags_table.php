<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_content');
            $table->unsignedBigInteger('id_tag');
            $table->timestamps();

            $table->foreign('id_content')->references('id')->on('contents');
            $table->foreign('id_tag')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_tags');
    }
}
