<?php

use App\Data\Models\Provider;
use Illuminate\Database\Seeder;

use App\Data\Models\Provider as ProviderModel;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProviderModel::class, 30)->create();
    }
}
