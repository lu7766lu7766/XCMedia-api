<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMovieTableStep3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movie', function (Blueprint $table) {
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
        Schema::table('movie', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
}
