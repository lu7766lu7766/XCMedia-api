<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreatePhotographAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photograph_album', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20)->comment('名稱');
            $table->string('cover_path')->nullable()->comment('圖片路徑');
            $table->string('cover_url')->nullable()->comment('圖片網址');
            $table->string('alias', 20)->nullable()->comment('別名');
            $table->unsignedInteger('region_id')->comment('地區id');
            $table->unsignedInteger('cup_id')->comment('罩杯id');
            $table->unsignedInteger('years_id')->comment('年份id');
            $table->json('tags')->nullable()->comment('標籤');
            $table->string('description')->nullable()->comment('描述');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->unsignedInteger('views')->default(0)->comment('瀏覽次數');
            $table->timestamps();
            //foreign key
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->foreign('cup_id')->references('id')->on('cup')->onDelete('cascade');
            $table->foreign('years_id')->references('id')->on('years')->onDelete('cascade');
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
        Schema::dropIfExists('photograph_album');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
