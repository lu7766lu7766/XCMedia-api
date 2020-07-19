<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_branch', function (Blueprint $table) {
            $table->unsignedInteger('branch_id')->comment('站台id');
            $table->integer('published_source_id')->comment('發佈來源id');
            $table->string('published_source_type')->comment('發佈來源');
            //foreign key
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('cascade');
            $table->unique(['branch_id', 'published_source_id', 'published_source_type'], 'published_branch_unique');
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
        Schema::dropIfExists('published_branch');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
