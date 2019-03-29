<?php

use Illuminate\Database\Seeder;

use App\Data\Models\Cycle as CycleModel;

class CyclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CycleModel::class, 50)->create();
    }
}
