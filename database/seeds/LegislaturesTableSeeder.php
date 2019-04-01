<?php

use Illuminate\Database\Seeder;

use App\Data\Models\Legislature as LegislatureModel;

class LegislaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(LegislatureModel::class, 50)->create();
    }
}
