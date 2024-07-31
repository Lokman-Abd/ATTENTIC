<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create(['group_id' => 1, 'group_name' => 'Group A']);
        Group::create(['group_id' => 2, 'group_name' => 'Group B']);
        Group::create(['group_id' => 3, 'group_name' => 'Group C']);
    }
}
