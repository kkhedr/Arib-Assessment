<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $department = Department::create([
            "name" => "IT"
        ]);

        $manager = User::create([
            "email" => "admin@arib.com",
            "first_name" => "admin",
            "last_name" => "admin",
            "salary" => "80000",
            "image" => "default.png",
            "department_id" => $department->id,
            "password" => "password",
            "is_admin" => 1
        ]);

        $role = Role::where('name', 'admin')->first();

        $manager->addRole($role);
    }
}
