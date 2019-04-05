<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('entry_id')->unsigned();
            $table->string('disk_name');
            $table->string('path');
            $table->string('name');

            $table->timestamp('approved_at')->nullable();
            $table
                ->bigInteger('approved_by_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('published_at')->nullable();
            $table
                ->bigInteger('published_by_id')
                ->unsigned()
                ->nullable();

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
        Schema::dropIfExists('entry_documents');
    }
}
