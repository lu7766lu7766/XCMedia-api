<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateCollectorTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collector_type', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('title', 50)->comment('名稱');
            $table->string('code', 10)->comment('代碼');
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
        Schema::dropIfExists('collector_type');
    }
}
