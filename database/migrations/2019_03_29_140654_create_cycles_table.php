<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('congressman_legislature_id')->unsigned();

            $table->year('year');

            $table->unsignedDecimal('month', 2, 0);

            $table->timestamp('published_at')->nullable();

            $table
                ->integer('published_by_id')
                ->unsigned()
                ->nullable();

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
        Schema::dropIfExists('cycles');
    }
}
