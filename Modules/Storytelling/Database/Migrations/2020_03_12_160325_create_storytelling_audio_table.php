<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorytellingAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storytelling_audio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('original_file_name')->comment('原檔案名稱');
            $table->string('file_path')->nullable()->comment('檔案路徑');
            $table->string('file_url')->nullable()->comment('檔案URL');
            $table->unsignedInteger('storytelling_id')->comment('成人說書id');
            $table->timestamps();
            //foreign keycle
            $table->foreign('storytelling_id')->references('id')->on('storytelling')->onDelete('cascade');
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
        Schema::dropIfExists('storytelling_audio');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
