<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDepartaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departaments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');

            $table->string('initials')->nullable();

            $table
                ->bigInteger('congressman_id')
                ->unsigned()
                ->nullable();

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table
                ->bigInteger('departament_id')
                ->unsigned()
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departaments');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('departament_id');
        });
    }
}
