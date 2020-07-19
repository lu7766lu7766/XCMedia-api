<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVarietyTableStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws \Doctrine\DBAL\DBALException
     */
    public function up()
    {
        Schema::getConnection()->getDoctrineSchemaManager()
            ->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        Schema::table('variety', function (Blueprint $table) {
            $table->unsignedInteger('language_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variety', function (Blueprint $table) {
            $table->unsignedInteger('language_id')->change();
        });
    }
}
