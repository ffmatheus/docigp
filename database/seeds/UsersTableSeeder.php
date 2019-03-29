<?php

use Illuminate\Database\Seeder;

use App\Data\Models\User as UserModel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserModel::class, 50)->create();
    }
}
