<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMemeberLoginHistoryTableStep2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_login_history', function (Blueprint $table) {
            $table->json('extra')->after('browser')->comment('額外資訊')->nullable();
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
            $table->dropColumn('extra');
        });
    }
}
