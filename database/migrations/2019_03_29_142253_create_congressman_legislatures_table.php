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

            $table->bigInteger('congressman_id')->unsigned();

            $table->bigInteger('legislature_id')->unsigned();

            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();

            $table
                ->bigInteger('created_by_id')
                ->unsigned()
                ->nullable();

            $table
                ->bigInteger('updated_by_id')
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
