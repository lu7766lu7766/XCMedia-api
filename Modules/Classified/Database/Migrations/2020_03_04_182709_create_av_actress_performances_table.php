<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvActressPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('av_actress_performances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('av_actress_id')->comment('女優id');
            $table->unsignedInteger('performances_id')->comment('表演id');
            $table->string('performances_type')->comment('表演類型');
            $table->timestamps();
            //foreign
            $table->foreign('av_actress_id')->references('id')->on('av_actress')->onDelete('cascade');
            //index
            $table->index(['av_actress_id', 'performances_id', 'performances_type'], 'idx_av_actress_performances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('av_actress_performances');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
