<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateNodeGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name', 50)->comment('預設顯示名稱');
            $table->string('code')->comment('代號');
            $table->enum('enable', NYEnumConstants::enum())->default(NYEnumConstants::YES)->comment('是否啟用');
            $table->enum('display', NYEnumConstants::enum())->default(NYEnumConstants::YES)->comment('是否顯示');
            $table->enum('public', NYEnumConstants::enum())->default(NYEnumConstants::NO)->comment('是否公開取用');
            $table->timestamps();
            // index
            $table->unique('code', 'node_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('node_group');
    }
}
