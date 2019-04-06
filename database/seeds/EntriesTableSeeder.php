<?php

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

        Congressman::all()->each(function ($congressman) {
            $congressman->budgets->each(function ($budget) use ($congressman) {
                factory(EntryModel::class, 1)->create([
                    'to' => $congressman->name,
                    'object' => 'Crédito em conta-corrente',
                    'provider_id' => null,
                    'cost_center_id' => 1,
                    'date' => Carbon::now()->startOfMonth(),
                    'value' => app(Faker::class)->randomFloat(2, 0.1, 1000),
                    'congressman_budget_id' => $budget->id,
                ]);
            });
        });

        foreach (range(1, 500) as $counter) {
            $entry = factory(EntryModel::class)->create([
                'value' => -app(Faker::class)->randomFloat(2, 0.1, 1000),
            ]);

            factory(EntryDocumentModel::class, rand(0, 8))->create([
                'entry_id' => $entry->id,
            ]);
        }
    }
}
