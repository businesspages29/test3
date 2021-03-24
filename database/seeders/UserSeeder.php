<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//custom
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
        	'name' => 'Bhargav Raviya', 
        	'email' => 'admin@admin.com',
        	'password' => bcrypt('password')
        ]);

    
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
    }
}
