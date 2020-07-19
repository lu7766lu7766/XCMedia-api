<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGenresTableStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('genres_used', function (Blueprint $table) {
            $table->index(['genres_id', 'genres_used_id', 'genres_used_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('genres_used', function (Blueprint $table) {
            $table->dropIndex(['genres_id', 'genres_used_id', 'genres_used_type']);
        });
    }
}
