<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin role
        DB::table('users')->insert([
        [
        'name'=>'SuperAdmin',
        'username'=>'superadmin',
        'email'=>'superadmin@gmail.com',
        'password'=>Hash::make('111'),
        'role'=>'admin',
        'status'=>'1'
        ],
        //Instructor Role
        [
            'name'=>'Instructor',
            'username'=>'instructor',
            'email'=>'instructor@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'instructor',
            'status'=>'1'
        ],

        //User Role
        [
            'name'=>'Roxas',
            'username'=>'roxasfoong',
            'email'=>'roxas.foong@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'user',
            'status'=>'1'
        ]       

        ]);
    }
    
}
