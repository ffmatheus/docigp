<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCongressmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congressmen', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('remote_id')->unsigned();
            $table->string('name');
            $table->string('nickname');
            $table->bigInteger('party_id')->unsigned();
            $table->string('photo_url');
            $table->string('thumbnail_url');

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
        Schema::dropIfExists('congressmen');
    }
}
