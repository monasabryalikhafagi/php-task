<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::firstOrCreate(
            ['slug' => 'hr'],
            [
                'name' => 'Hr',
                'slug' => Str::slug('Hr', '-'),
                'description' => 'Hr hr',
            ]
        );
        Department::firstOrCreate(
            ['slug' => 'developers'],
            [
                'name' => 'Developers',
                'slug' => Str::slug('Developers', '-'),
                'description' => 'Developers Developers',
            ]
        );
    }
}
