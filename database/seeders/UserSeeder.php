<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '1234567890',
                'role' => 'admin',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ]
        );    
        $developersDept = Department::where('slug','developers')->first();

        User::firstOrCreate(
            ['email' => 'manger@gmail.com'],
            [
                'first_name' => 'Manger',
                'last_name' => 'Manger',
                'email' => 'manger@gmail.com',
                'phone' => '1234567891',
                'role' => 'manger',
                'department_id'=> $developersDept?->id ,
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'employee@gmail.com'],
            [
                'first_name' => 'employee',
                'last_name' => 'employee',
                'email' => 'employee@gmail.com',
                'phone' => '1234567892',
                'role' => 'employee',
                'department_id'=> $developersDept?->id ,
                'manger_id' => User::where('email','manger@gmail.com')->first()?->id,
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ]
        );


    }
}
