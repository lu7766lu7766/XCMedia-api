<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_source', function (Blueprint $table) {
            $table->unsignedInteger('episode_id')->comment('集數id');
            $table->unsignedInteger('source_id')->comment('來源id');
            $table->string('url')->nullable()->comment('連結');
            //foreign
            $table->foreign('episode_id')->references('id')->on('episode')->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('source')->onDelete('cascade');
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
        Schema::dropIfExists('episode_source');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
