<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'payslip-list',
           'payslip-create',
           'payslip-edit',
           'payslip-delete',
           'quotation-list',
           'quotation-create',
           'quotation-edit',
           'quotation-delete',

           'salesorder-list',
           'salesorder-create',
           'salesorder-edit',
           'salesorder-delete',

           'payments-list',
           'payments-create',
           'payments-edit',
           'payments-delete',

           'appointments-list',
           'appointments-create',
           'appointments-edit',
           'appointments-delete',

           'scheduling',
           'settings',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
