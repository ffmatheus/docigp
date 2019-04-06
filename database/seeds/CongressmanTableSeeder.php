<?php

use Illuminate\Database\Seeder;
use App\Data\Models\Congressman;

class CongressmanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Congressman::class, 5)->create();
    }
}
