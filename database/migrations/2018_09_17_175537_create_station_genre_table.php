<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_genre', function (Blueprint $table) {
            $table->integer('station_id')->unsigned()->nullable();
            $table->foreign('station_id')->references('id')
                ->on('stations')->onDelete('cascade');

            $table->integer('genre_id')->unsigned()->nullable();
            $table->foreign('genre_id')->references('id')
                ->on('genres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_genre');
    }
}
