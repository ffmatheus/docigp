<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attached_files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table
                ->integer('file_id')
                ->unsigned()
                ->index();
            $table->string('file_type');

            $table->text('original_name');
            $table->text('mime_type');

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
        Schema::dropIfExists('attached_files');
    }
}
