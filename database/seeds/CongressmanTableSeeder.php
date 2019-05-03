<?php

use App\Data\Models\User;
use App\Support\Constants;
use Illuminate\Database\Seeder;
use App\Data\Models\Department;
use App\Data\Models\Congressman;
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
        $department = factory(Department::class)->create([
            'name' => ($name = 'Manuel Francisco dos Santos'),
        ]);

        $congressman = factory(Congressman::class)->create([
            'name' => $name,
            'department_id' => $department->id,
        ]);

        factory(CongressmanLegislature::class)->create([
            'congressman_id' => $congressman->id,
        ]);

        $user = factory(User::class)->create([
            'name' => $name,
            'email' => 'docigp@alerj.rj.gov.br',
            'congressman_id' => $congressman->id,
            'department_id' => $department->id,
        ]);

        $user->assign(Constants::ROLE_CONGRESSMAN);
    }
}
