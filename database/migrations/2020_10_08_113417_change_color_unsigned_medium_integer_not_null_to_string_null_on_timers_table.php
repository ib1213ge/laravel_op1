<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColorUnsignedMediumIntegerNotNullToStringNullOnTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timers', function (Blueprint $table) {
            $table->string('color')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timers', function (Blueprint $table) {
            $table->unsignedInteger('color')->nullable(false)->change();
        });
    }
}
