<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('會員id');
            $table->unsignedInteger('media_id')->comment('收藏的影音id');
            $table->string('media_type')->comment('收藏的影音分類');
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
            $table->unique(['member_id', 'media_id', 'media_type']);
            $table->index('media_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('my_favorite');
        Schema::enableForeignKeyConstraints();
    }
}
