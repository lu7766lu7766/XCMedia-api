<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComicEpisodeGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comic_episode_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('comic_episode_id')->comment('集數id');
            $table->unsignedInteger('comic_gallery_id')->comment('圖片id');
            $table->foreign('comic_episode_id')->references('id')->on('comic_episode')->onDelete('cascade');
            $table->foreign('comic_gallery_id')->references('id')->on('comic_gallery')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('comic_episode_gallery');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
