<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StationError extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stations', function (Blueprint $table){
           $table->integer('errors')->nullable();
        });
        Schema::table('streams', function (Blueprint $table){
           $table->integer('errors')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stations', function (Blueprint $table){
            $table->dropColumn('errors');
        });
        Schema::table('streams', function (Blueprint $table){
            $table->dropColumn('errors');
        });
    }
}
