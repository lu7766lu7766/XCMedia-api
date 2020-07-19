<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_comment', function (Blueprint $table) {
            $table->unsignedInteger('member_id')->comment('會員id');
            $table->string('contents')->comment('內容');
            $table->unsignedInteger('commented_id')->comment('被評論方id');
            $table->string('commented_type')->comment('被評論方類型');
            $table->timestamps();
            //foreign
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
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
        Schema::dropIfExists('member_comment');
        Schema::enableForeignKeyConstraints();
    }
}
