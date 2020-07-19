<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdultVideoTableStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adult_video', function (Blueprint $table) {
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
        Schema::table('selfie_schedule', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
}
