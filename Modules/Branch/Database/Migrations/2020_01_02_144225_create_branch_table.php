<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->comment('站台名稱');
            $table->string('code', 30)->comment('代碼');
            $table->string('domain')->comment('域名');
            $table->enum('status', NYEnumConstants::enum())->comment('狀態');
            $table->enum('is_register', NYEnumConstants::enum())->comment('是否開放會員註冊');
            $table->text('remark')->nullable()->comment('備註');
            $table->timestamps();
            $table->softDeletes();
            //unique
            $table->unique('code', 'branch_code_unique');
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
        Schema::dropIfExists('branch');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
