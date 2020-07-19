<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Constants\NYEnumConstants;

class CreateStorytellingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storytelling', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 20)->comment('名稱');
            $table->string('cover_path')->comment('封面路徑')->nullable();
            $table->string('cover_url')->comment('封面URL')->nullable();
            $table->string('alias', 20)->comment('別名')->nullable();
            $table->unsignedInteger('region_id')->comment('地區id');
            $table->unsignedInteger('years_id')->comment('年份id');
            $table->json('tags')->comment('標籤')->nullable();
            $table->text('description')->comment('描述')->nullable();
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->bigInteger('views')->default(0)->comment('瀏覽次數');
            $table->timestamps();
            //foreign
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
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
        Schema::dropIfExists('storytelling');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
