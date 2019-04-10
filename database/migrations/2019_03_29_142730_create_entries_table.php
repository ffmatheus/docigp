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
            $table->decimal('value', 20, 2);

            $table->string('object');

            $table->string('to');

            $table
                ->bigInteger('entry_type_id')
                ->unsigned()
                ->nullable();

            $table->string('document_number')->nullable();

            $table
                ->bigInteger('provider_id')
                ->unsigned()
                ->nullable();

            $table
                ->bigInteger('cost_center_id')
                ->unsigned()
                ->nullable();

            $table
                ->bigInteger('congressman_budget_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('verified_at')->nullable();
            $table->timestamp('analysed_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table
                ->bigInteger('verified_by_id')
                ->unsigned()
                ->nullable();

            $table
                ->bigInteger('analysed_by_id')
                ->unsigned()
                ->nullable();

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
        Schema::dropIfExists('entries');
    }
}
