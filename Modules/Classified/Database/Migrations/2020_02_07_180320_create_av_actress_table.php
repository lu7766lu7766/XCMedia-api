<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateAvActressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('av_actress', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->comment('名稱');
            $table->string('alias', 20)->nullable()->comment('別名');
            $table->string('image_path')->nullable()->comment('圖片位置');
            $table->string('image_url')->nullable()->comment('圖片連結');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->string('note')->nullable()->comment('備註');
            $table->string('used_type')->comment('使用方');
            $table->timestamps();
            $table->index(['used_type', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('av_actress');
    }
}
