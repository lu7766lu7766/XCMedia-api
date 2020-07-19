<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\NYEnumConstants;

class CreateRoleNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_node', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->comment('角色id');
            $table->unsignedInteger('node_id')->comment('節點id');
            $table->enum('enable', NYEnumConstants::enum())->default(NYEnumConstants::YES)->comment('節點id');
            $table->timestamps();
            // index
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            $table->foreign('node_id')->references('id')->on('node')->onDelete('cascade');
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
        Schema::dropIfExists('role_node');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
