<?php

use Illuminate\Database\Seeder;
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
        $data = [
            [
                'name'=>'Super Admin', 
                'email'=>'admin@theempowermentnetwork.ng', 
                'email_verified_at'=>\Carbon\Carbon::now(), 
                'password'=>\Hash::make('password123'), 
                'phone'=>'07000000000', 
                'is_admin'=>true, 
            ],
        ];

        foreach ($data as $dat) {
            $user = User::create($dat);
            $user->assignRole('super admin');
        }
    }
}
