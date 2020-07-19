<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdvertisementTypeStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisement_type', function (Blueprint $table) {
            $table->string('size_hint')->comment('廣告圖片尺寸提示');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisement_type', function (Blueprint $table) {
            $table->dropColumn('size_hint');
        });
    }
}
