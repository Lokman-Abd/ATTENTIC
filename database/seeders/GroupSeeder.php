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
        // TODO fix this to in one querry
        Group::create(['name' => 'Group A']);
        Group::create(['name' => 'Group B']);
        Group::create(['name' => 'Group C']);
    }
}
