<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateAdultVideoBucketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adult_video_bucket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_path')->nullable()->comment('檔案路徑');
            $table->string('file_url')->nullable()->comment('檔案URL');
            $table->timestamp('release_time')->comment('開放時間');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->unsignedInteger('adult_video_id')->comment('成人視頻id');
            $table->timestamps();
            //foreign key
            $table->foreign('adult_video_id')->references('id')->on('adult_video')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adult_video_bucket');
    }
}
