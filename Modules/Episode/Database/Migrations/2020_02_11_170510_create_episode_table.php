<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 30)->comment('名稱');
            $table->dateTime('opening_time')->comment('開放時間');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->integer('views')->default(0)->comment('瀏覽次數');
            $table->string('media_id')->comment('影音id');
            $table->string('media_type')->comment('影音類型');
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
        Schema::dropIfExists('episode');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
