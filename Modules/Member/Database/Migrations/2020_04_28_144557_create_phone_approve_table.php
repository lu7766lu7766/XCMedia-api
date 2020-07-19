<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreatePhoneApproveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_approve', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 32)->unique()->comment('會員帳號(電話)');
            $table->string('code', 10)->comment('驗證碼');
            $table->enum('status', NYEnumConstants::enum())
                ->default(NYEnumConstants::NO)
                ->comment('驗證碼狀態(Y:已使用 N:未使用');
            $table->timestamps();
            $table->index(['account', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_approve');
    }
}
