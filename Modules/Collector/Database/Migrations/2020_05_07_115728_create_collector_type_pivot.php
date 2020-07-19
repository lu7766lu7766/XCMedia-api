<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectorTypePivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collector_type_pivot', function (Blueprint $table) {
            $table->unsignedInteger('setting_id')->comment('采集設定的id');
            $table->unsignedInteger('type_id')->comment('類型id');
            //foreign
            $table->foreign('setting_id')->references('id')->on('collector_setting')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('collector_type')->onDelete('cascade');
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
        Schema::dropIfExists('collector_type_pivot');
        Schema::enableForeignKeyConstraints();
    }
}
