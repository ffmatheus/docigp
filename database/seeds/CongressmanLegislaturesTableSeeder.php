<?php

use Illuminate\Database\Seeder;

use App\Data\Models\CongressmanLegislature as CongressmanLegislatureModel;

class CongressmanLegislaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CongressmanLegislatureModel::class, 50)->create();
    }
}
