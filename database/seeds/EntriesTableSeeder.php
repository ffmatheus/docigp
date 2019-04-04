<?php

use Illuminate\Database\Seeder;

use App\Data\Models\Entry as EntryModel;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EntryModel::class, 500)->create();
    }
}
