<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfieScheduleAvActressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selfie_schedule_av_actress', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('selfie_schedule_id');
            $table->unsignedInteger('av_actress_id');
            $table->timestamps();
            // index
            $table->foreign('selfie_schedule_id')->references('id')->on('selfie_schedule')->onDelete('cascade');
            $table->foreign('av_actress_id')->references('id')->on('av_actress')->onDelete('cascade');
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
        Schema::dropIfExists('selfie_schedule_av_actress');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
