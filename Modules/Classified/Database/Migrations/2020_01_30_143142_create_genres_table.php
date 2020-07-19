<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Constants\NYEnumConstants;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->comment('名稱');
            $table->text('remark')->nullable()->comment('備註');
            $table->string('image_path')->nullable()->comment('圖片位置');
            $table->string('image_url')->nullable()->comment('圖片連結');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->string('used_type')->comment('使用方');
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
        Schema::dropIfExists('genres');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
