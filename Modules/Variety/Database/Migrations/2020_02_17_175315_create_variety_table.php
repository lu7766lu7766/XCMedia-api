<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Episode\Constants\EpisodeStatusConstants;

class CreateVarietyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variety', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->comment('名稱');
            $table->string('alias', 50)->nullable()->comment('別名');
            $table->string('image_path')->nullable()->comment('圖片位置');
            $table->string('image_url')->nullable()->comment('圖片連結');
            $table->enum('episode_status', EpisodeStatusConstants::enum())
                ->default(EpisodeStatusConstants::SERIALIZING)->comment('集數狀態');
            $table->enum('status', NYEnumConstants::enum())->default(NYEnumConstants::YES)->comment('狀態');
            $table->string('host')->nullable()->comment('主持');
            $table->string('guest')->nullable()->comment('來賓');
            $table->unsignedInteger('region_id')->comment('地區id');
            $table->unsignedInteger('years_id')->comment('年份id');
            $table->unsignedInteger('language_id')->comment('語言id');
            $table->text('description')->nullable()->comment('描述');
            $table->integer('views')->default(0)->comment('瀏覽次數');
            $table->timestamps();
            //foreign
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->foreign('years_id')->references('id')->on('years')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');
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
        Schema::dropIfExists('variety');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
