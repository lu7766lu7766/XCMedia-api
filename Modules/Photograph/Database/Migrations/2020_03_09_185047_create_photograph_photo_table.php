<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotographPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photograph_photo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('檔案名稱');
            $table->string('file_path')->comment('檔案路徑');
            $table->string('file_url')->comment('檔案網址');
            $table->unsignedInteger('photograph_album_id')->comment('攝影專輯id');
            $table->timestamps();
            //foreign key
            $table->foreign('photograph_album_id')->references('id')->on('photograph_album')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photograph_photo');
    }
}
