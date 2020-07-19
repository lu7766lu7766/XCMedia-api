<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateLiteratureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('literature', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover_url')->nullable()->comment('圖片連結');
            $table->string('cover_path')->nullable()->comment('圖片路徑');
            $table->string('title', 20)->comment('名稱, 上限20字');
            $table->unsignedInteger('region_id')->comment('地區id');
            $table->unsignedInteger('year_id')->comment('年份id');
            $table->unsignedInteger('views')->default(0)->comment('瀏覽次數');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->string('tags')->nullable()->comment('標籤');
            $table->text('description')->nullable()->comment('描述');
            $table->string('alias', 20)->nullable()->comment('別名');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('literature');
        Schema::enableForeignKeyConstraints();
    }
}
