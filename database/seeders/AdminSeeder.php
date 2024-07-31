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
      $admin->admin_first_name = 'John';
      $admin->admin_last_name = 'Doe';
      $admin->admin_password = Hash::make('123456'); // Use Hash facade to hash the password
      $admin->admin_email = 'lokmane.abdessalam@univ-constantine2.dz';
      $admin->save();
    }
}
