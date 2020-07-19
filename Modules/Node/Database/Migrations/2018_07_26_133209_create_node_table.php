<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('enable', NYEnumConstants::enum())->default(NYEnumConstants::YES)->comment('是否啟用');
            $table->enum('display', NYEnumConstants::enum())->default(NYEnumConstants::YES)->comment('是否顯示');
            $table->enum('public', NYEnumConstants::enum())->default(NYEnumConstants::NO)->comment('是否公開取用');
            $table->string('display_name', 50)->comment('預設顯示名稱');
            $table->string('code')->comment('代號');
            $table->unsignedInteger('node_group_id')->nullable()->default(null)->comment('父節點');
            $table->timestamps();
            // index
            $table->unique('code', 'node_code_unique');
            $table->foreign('node_group_id')->references('id')->on('node_group')->onDelete('cascade');
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
        Schema::dropIfExists('node');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
