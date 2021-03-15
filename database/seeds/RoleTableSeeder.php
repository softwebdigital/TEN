<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
    		['name' => 'view volunteers'],
    		['name' => 'create volunteers'],
    		['name' => 'edit volunteers'],
    		['name' => 'delete volunteers'],
    		['name' => 'view beneficiaries'],
    		['name' => 'create beneficiaries'],
    		['name' => 'edit beneficiaries'],
    		['name' => 'delete beneficiaries'],
    		['name' => 'view groups'],
    		['name' => 'create groups'],
    		['name' => 'delete groups'],
    		['name' => 'edit groups'],
    		['name' => 'view pending payments'],
    		['name' => 'create pending payments'],
    		['name' => 'view admins'],
    		['name' => 'edit admins'],
    		['name' => 'create admins'],
    		['name' => 'delete admins'],
    		['name' => 'view roles'],
    		['name' => 'create roles'],
    		['name' => 'edit roles'],
    		['name' => 'delete roles'],
    		['name' => 'view thrifts'],
    		['name' => 'create thrifts'],
    		['name' => 'edit thrifts'],
    		['name' => 'delete thrifts'],
    		['name' => 'view payments'],
    		['name' => 'edit payments'],
    		['name' => 'create payments'],
    		['name' => 'delete payments'],
    	];
        Role::create(['name'=>'user']);
        $role = Role::create(['name'=>'super admin']);
        foreach ($data as $dat) {
        	$perm = Permission::create($dat);
        	$role->givePermissionTo($perm);
        }
    }
}
