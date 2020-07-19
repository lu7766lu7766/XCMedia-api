<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class UpdateShortFilmTableStep2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('short_film', function (Blueprint $table) {
            $table->enum('video_status', NYEnumConstants::enum())->nullable()->comment('影片狀態');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('short_film', function (Blueprint $table) {
            $table->dropColumn('video_status');
        });
    }
}
