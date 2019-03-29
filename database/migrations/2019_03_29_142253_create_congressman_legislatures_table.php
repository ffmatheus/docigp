<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCongressmanLegislaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congressman_legislatures', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('congressman_id')->unsigned();

            $table->integer('legislature_id')->unsigned();

            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();

            $table
                ->integer('created_by_id')
                ->unsigned()
                ->nullable();

            $table
                ->integer('updated_by_id')
                ->unsigned()
                ->nullable();

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
        Schema::dropIfExists('congressman_legislatures');
    }
}
