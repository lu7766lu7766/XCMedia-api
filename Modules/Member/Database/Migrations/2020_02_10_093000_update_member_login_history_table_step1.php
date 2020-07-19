<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMemberLoginHistoryTableStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_login_history', function (Blueprint $table) {
            $table->string('browser')->after('device')->comment('瀏覽器資訊');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_login_history', function (Blueprint $table) {
            $table->dropColumn('browser');
        });
    }
}
