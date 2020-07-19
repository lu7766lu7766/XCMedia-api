<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateLiteratureVolumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('literature_volume', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('名稱');
            $table->dateTime('open_at')->comment('開放時間');
            $table->integer('views')->default(0)->comment('瀏覽次數');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->unsignedInteger('literature_id')->comment('所屬文學id');
            $table->text('content')->nullable()->comment('內容');
            $table->timestamps();
            $table->foreign('literature_id')->references('id')->on('literature')->onDelete('cascade');
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
        Schema::dropIfExists('literature_volume');
        Schema::enableForeignKeyConstraints();
    }
}
