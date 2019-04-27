<?php

use App\Data\Models\Congressman;
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
        factory(Congressman::class)->create([
            'name' => 'Manuel Francisco dos Santos'
        ]);

        factory(CongressmanLegislature::class, 5)->create();
    }
}
