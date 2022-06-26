<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\Role([
            'title'=>'Admin',
            'description'=>'This is Admin role - It gives expanded rights to the user!'            
         ]);
        $role->save();

        $role = new \App\Role([
            'title'=>'User',
            'description'=>'This is User role - It gives regular rights to the user!'            
         ]);
        $role->save();
    }
}
