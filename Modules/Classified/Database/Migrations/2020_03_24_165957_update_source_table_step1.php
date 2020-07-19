<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSourceTableStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('source', function (Blueprint $table) {
            $table->string('analyze_address')->after('status')->nullable()->comment('解析地址');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('source', function (Blueprint $table) {
            $table->dropColumn('analyze_address');
        });
    }
}
