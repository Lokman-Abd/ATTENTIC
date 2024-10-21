<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Create a new admin user
      $admin = new Admin;
      $admin->first_name = 'John';
      $admin->last_name = 'Doe';
      $admin->password = '123456'; // Use Hash facade to hash the password
      $admin->email = 'lokmane.abdessalam@univ-constantine2.dz';
      $admin->save();
    }
}
