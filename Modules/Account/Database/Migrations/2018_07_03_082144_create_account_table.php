<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Account\Constants\AccountStatusConstants;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 32)->comment('帳號');
            $table->string('password')->comment('密碼');
            $table->string('display_name', 50)->nullable()->comment('呈現文字');
            $table->enum('status', AccountStatusConstants::enum())
                ->default(AccountStatusConstants::ENABLE)->comment('狀態');
            $table->string('mail')->nullable()->comment('信箱');
            $table->string('phone')->nullable()->comment('手機');
            $table->string('login_ip', 30)->nullable()->comment('來源IP');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('account');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
