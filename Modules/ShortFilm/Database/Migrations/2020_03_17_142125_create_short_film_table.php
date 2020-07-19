<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;
use Modules\ShortFilm\Constants\MosaicConstants;

class CreateShortFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_film', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20)->comment('名稱');
            $table->string('alias', 20)->nullable()->comment('別名');
            $table->enum('mosaic_type', MosaicConstants::enum())->comment('片種');
            $table->unsignedInteger('region_id')->comment('地區id');
            $table->unsignedInteger('cup_id')->comment('罩杯id');
            $table->unsignedInteger('year_id')->comment('年份id');
            $table->string('tags')->nullable()->comment('標籤');
            $table->text('description')->nullable()->comment('描述');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->string('cover_path')->nullable()->comment('封面路徑');
            $table->string('cover_url')->nullable()->comment('封面連結');
            $table->string('video_path')->nullable()->comment('影片路徑');
            $table->string('video_url')->nullable()->comment('影片連結');
            $table->dateTime('open_at')->nullable()->comment('開放時間');
            $table->timestamps();
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->foreign('cup_id')->references('id')->on('cup')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
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
        Schema::dropIfExists('short_film');
        Schema::enableForeignKeyConstraints();
    }
}
