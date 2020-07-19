<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberLoginHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_login_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('會員id');
            $table->string('login_ip', 64)->nullable()->comment('來源IP');
            $table->string('location', 64)->nullable()->comment('地區');
            $table->string('isp', 64)->nullable()->comment('網路服務供應商');
            $table->string('device', 64)->nullable()->comment('裝置');
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
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
        Schema::dropIfExists('member_login_history');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
