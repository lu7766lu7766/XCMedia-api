<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDramaTableStep3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drama', function (Blueprint $table) {
            $table->float('score', 3, 1)->default(0)->comment('評分')->after('views');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drama', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
}
