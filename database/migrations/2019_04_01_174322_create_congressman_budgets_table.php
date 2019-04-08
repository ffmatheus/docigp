<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCongressmanBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congressman_budgets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table
                ->bigInteger('congressman_legislature_id')
                ->unsigned()
                ->nullable();

            $table->bigInteger('budget_id')->unsigned();

            $table->decimal('percentage', 20, 2);

            $table->decimal('value', 20, 2);

            $table
                ->bigInteger('analysed_by_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('analysed_at')->nullable();

            $table
                ->bigInteger('published_by_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('published_at')->nullable();

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
        Schema::dropIfExists('congressman_budgets');
    }
}
