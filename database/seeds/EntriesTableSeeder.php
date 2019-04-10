<?php

use App\Data\Models\CongressmanBudget;
use Carbon\Carbon as Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Data\Models\Congressman;
use App\Data\Models\Entry as EntryModel;
use App\Data\Models\EntryDocument as EntryDocumentModel;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntryModel::truncate();
        EntryDocumentModel::truncate();

        Congressman::whereIn('id', range(1, 10))
            ->get()
            ->each(function ($congressman) {
                $congressman->congressmanBudgets->each(function (
                    CongressmanBudget $congressmanBudget
                ) use ($congressman) {
                    $entry = factory(EntryModel::class, 1)->create([
                        'to' => $congressman->name,
                        'object' => 'Crédito em conta-corrente',
                        'provider_id' => null,
                        'cost_center_id' => 1,
                        'date' => $congressmanBudget->budget->date->startOfMonth(),
                        'value' => ($value = app(Faker::class)->randomFloat(
                            2,
                            0.1,
                            26000
                        )),
                        'congressman_budget_id' => $congressmanBudget->id,
                    ]);

                    $entry[0]->congressmanBudget->percentage =
                        ($value / $entry[0]->congressmanBudget->budget->value) *
                        100;

                    $entry[0]->congressmanBudget->save();

                    foreach (range(1, rand(1, 6)) as $counter) {
                        $entry = factory(EntryModel::class)->create([
                            'date' => faker()->dateTimeBetween(
                                $congressmanBudget->budget->date->startOfMonth(),
                                $congressmanBudget->budget->date->endOfMonth(),
                                $timezone = null
                            ),

                            'value' => -app(Faker::class)->randomFloat(
                                2,
                                0.1,
                                1000
                            ),

                            'congressman_budget_id' => $congressmanBudget->id,
                        ]);

                        factory(EntryDocumentModel::class, rand(0, 8))->create([
                            'entry_id' => $entry->id,
                        ]);
                    }

                    $congressmanBudget->updateTransportEntries();
                });
            });
    }
}
