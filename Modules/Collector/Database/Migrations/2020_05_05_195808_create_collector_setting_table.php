<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateCollectorSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collector_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('collector_source_id')->unique()->comment('收集資源id');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->timestamps();
            //foreign
            $table->foreign('collector_source_id')->references('id')->on('collector_source')->onDelete('cascade');
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
        Schema::dropIfExists('collector_setting');
        Schema::enableForeignKeyConstraints();
    }
}
