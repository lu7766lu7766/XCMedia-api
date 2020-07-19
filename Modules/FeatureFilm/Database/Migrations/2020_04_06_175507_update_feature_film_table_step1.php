<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class UpdateFeatureFilmTableStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feature_film', function (Blueprint $table) {
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
        Schema::table('feature_film', function (Blueprint $table) {
            $table->dropColumn('video_status');
        });
    }
}
