<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamp('date');
            $table->float('value', 20, 2);

            $table->string('object');
            $table->string('to');

            $table
                ->integer('cycle_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('verified_at')->nullable();
            $table->timestamp('authorised_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table
                ->integer('verified_by_id')
                ->unsigned()
                ->nullable();

            $table
                ->integer('authorised_by_id')
                ->unsigned()
                ->nullable();

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
        Schema::dropIfExists('entries');
    }
}
