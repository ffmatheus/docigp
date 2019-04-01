<?php

use Silber\Bouncer\Database\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Models::table('files'), function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('hash');
            $table->string('drive');
            $table->string('path');
            $table->string('public_url');

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
        Schema::drop(Models::table('files'));
    }
}
