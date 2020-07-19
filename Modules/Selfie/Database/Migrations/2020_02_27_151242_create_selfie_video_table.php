<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateSelfieVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selfie_video', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('名稱');
            $table->string('cover_path')->comment('封面路徑')->nullable();
            $table->string('cover_url')->comment('封面URL')->nullable();
            $table->string('video_path')->comment('影片路徑')->nullable();
            $table->string('video_url')->comment('影片URL')->nullable();
            $table->timestamp('release_date')->nullable()->comment('上映時間');
            $table->enum('status', NYEnumConstants::enum());
            $table->bigInteger('views')->default(0)->comment('瀏覽次數');
            $table->unsignedInteger('selfie_schedule_id')->comment('自拍節目表id');
            $table->timestamps();
            //foreign
            $table->foreign('selfie_schedule_id')->references('id')->on('selfie_schedule')->onDelete('cascade');
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
        Schema::dropIfExists('selfie_video');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
