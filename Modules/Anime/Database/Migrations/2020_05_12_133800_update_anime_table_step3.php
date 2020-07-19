<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/5/12
 * Time: 下午 01:37
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAnimeTableStep3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anime', function (Blueprint $table) {
            $table->unsignedDecimal('score', 3, 1)->default(0)->after('views')->comment('評分');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anime', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
}
