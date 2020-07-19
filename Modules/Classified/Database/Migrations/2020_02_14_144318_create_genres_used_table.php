<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresUsedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres_used', function (Blueprint $table) {
            $table->unsignedInteger('genres_id')->comment('類型id');
            $table->unsignedInteger('genres_used_id')->comment('使用方id');
            $table->string('genres_used_type')->comment('使用方類型');
            //foreign
            $table->foreign('genres_id')->references('id')->on('genres')->onDelete('cascade');
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
        Schema::dropIfExists('genres_used');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
