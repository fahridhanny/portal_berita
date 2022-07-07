<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_related', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_content');
            $table->unsignedBigInteger('id_related');
            $table->timestamps();

            $table->foreign('id_content')->references('id')->on('contents');
            $table->foreign('id_related')->references('id')->on('contents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_related');
    }
}
