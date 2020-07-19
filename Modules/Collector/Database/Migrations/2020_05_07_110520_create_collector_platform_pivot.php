<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectorPlatformPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collector_platform_pivot', function (Blueprint $table) {
            $table->unsignedInteger('setting_id')->comment('采集設定的id');
            $table->unsignedInteger('platform_id')->comment('平台id');
            //foreign
            $table->foreign('setting_id')->references('id')->on('collector_setting')->onDelete('cascade');
            $table->foreign('platform_id')->references('id')->on('collector_platform')->onDelete('cascade');
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
        Schema::dropIfExists('collector_platform_pivot');
        Schema::enableForeignKeyConstraints();
    }
}
