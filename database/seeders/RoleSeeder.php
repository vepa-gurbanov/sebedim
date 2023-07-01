<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objs = [
            'Admin',
            'Brand Manager',
            'Category Manager',
            'CEO',
            'Customer Manager',
            'Human Resources Manager',
            'Inventory Manager',
            'Order Manager',
            'Product Manager',
            'Role Manager',
            'Sales Manager',
            'User Manager',
            'User Agent Manager',
            'Auth Attempt Manager',
            'Visitor Manager',
        ];

        foreach ($objs as $obj) {
            Role::create([
                'name' => $obj,
                'ability' => str($obj)->slug('_'),
            ]);
        }
    }
}
