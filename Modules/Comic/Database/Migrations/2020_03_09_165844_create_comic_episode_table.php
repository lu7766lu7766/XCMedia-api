<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateComicEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comic_episode', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('comic_id')->comment('漫畫id');
            $table->string('title', 30)->comment('名稱');
            $table->dateTime('opening_time')->comment('開放時間');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->unsignedInteger('views')->default(0)->comment('瀏覽次數');
            $table->timestamps();
            $table->foreign('comic_id')->references('id')->on('comic')->onDelete('cascade');
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
        Schema::dropIfExists('comic_episode');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
