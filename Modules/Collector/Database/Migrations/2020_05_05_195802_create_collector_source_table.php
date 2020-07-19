<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateCollectorSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collector_source', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('title', 50)->comment('名稱');
            $table->string('url')->comment('連結');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->timestamps();
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collector_source');
    }
}
