<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('track_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('uri')->nullable();
            $table->string('from_id')->nullable();
            $table->integer('promo_id')->nullable();
            $table->integer('previous_id')->nullable();
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
        Schema::dropIfExists('track_visits');
    }
}
