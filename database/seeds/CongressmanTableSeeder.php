<?php

use Illuminate\Database\Seeder;
use App\Data\Models\CongressmanLegislature;

class CongressmanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CongressmanLegislature::class, 5)->create();
    }
}
