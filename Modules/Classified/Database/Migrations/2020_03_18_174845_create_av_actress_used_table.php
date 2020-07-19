<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvActressUsedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('av_actress_used', function (Blueprint $table) {
            $table->unsignedInteger('av_actress_id')->comment('女優id');
            $table->unsignedInteger('av_actress_used_id')->comment('使用方id');
            $table->string('av_actress_used_type')->comment('使用方類型');
            $table->foreign('av_actress_id')->references('id')->on('av_actress')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('av_actress_used');
        Schema::enableForeignKeyConstraints();
    }
}
