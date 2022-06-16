<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_content');
            $table->string('meta_title');
            $table->string('meta_desc');
            $table->string('meta_keywords');
            $table->string('meta_title_en');
            $table->string('meta_desc_en');
            $table->string('meta_keywords_en');
            $table->timestamps();

            $table->foreign('id_content')->references('id')->on('contents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_contents');
    }
}
