<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberViewedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_viewed', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('會員id');
            $table->unsignedInteger('media_id')->comment('影音id');
            $table->string('media_type')->comment('影音類型');
            $table->timestamps();
            //foreign key
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
            //unique
            $table->unique(['member_id', 'media_id', 'media_type']);
            //index
            $table->index('media_type');
            $table->index(['media_id', 'media_type']);
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
        Schema::dropIfExists('member_viewed');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
