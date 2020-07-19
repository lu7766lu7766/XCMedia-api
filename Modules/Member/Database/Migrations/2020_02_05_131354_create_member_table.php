<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Member\Constants\MemberStatusConstants;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id')->comment('站台id');
            $table->string('account', 32)->comment('帳號');
            $table->string('password')->comment('密碼');
            $table->string('display_name', 50)->nullable()->comment('呈現文字');
            $table->enum('status', MemberStatusConstants::enum())
                ->default(MemberStatusConstants::ENABLE)->comment('狀態');
            $table->string('mail')->nullable()->comment('信箱');
            $table->enum('mail_approve', NYEnumConstants::enum())
                ->default(NYEnumConstants::NO)->comment('信箱驗證');
            $table->string('phone')->nullable()->comment('手機');
            $table->enum('phone_approve', NYEnumConstants::enum())
                ->default(NYEnumConstants::NO)->comment('手機驗證');
            $table->text('remark')->nullable()->comment('備註');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['branch_id', 'account']);
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('cascade');
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
        Schema::dropIfExists('member');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
