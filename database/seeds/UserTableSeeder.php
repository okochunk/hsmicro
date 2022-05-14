<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_customer  = Role::where('name', 'customer')->first();

        $employee = new User();
        $employee->name = 'Administrator';
        $employee->uuid = '4dm1n';
        $employee->email = 'admin@email.com';
        $employee->password = bcrypt('secret');
        $employee->company = 'hsmicro';
        $employee->is_active = 1;
        $employee->save();
        $employee->roles()->attach($role_admin);


       $manager = new User();
       $manager->name = 'Staff';
       $manager->uuid = 's123';
       $manager->email = 'staff@email.com';
       $manager->password = bcrypt('secret');
       $manager->company = 'upwork';
       $manager->is_active = 1;
       $manager->save();
       $manager->roles()->attach($role_customer);
    }
}
