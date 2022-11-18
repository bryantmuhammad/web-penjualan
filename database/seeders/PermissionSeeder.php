<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'crud_admin',
            'laporan_admin',
            'transaksi_admin',
            'crud_customer',
            'transaksi_customer',
            'laporan_customer'
        ];

        $userPermission = [
            'admin' => [
                'crud_admin',
                'laporan_admin',
                'transaksi_admin'
            ],
            'pemilik' => [
                'laporan_admin'
            ],
            'customer' => [
                'crud_customer',
                'transaksi_customer',
                'laporan_customer'
            ],

        ];

        foreach ($permissions as $key => $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($userPermission as $role => $permission) {
            $role = Role::create(['name' => $role]);
            $role->givePermissionTo($permission);
        }
    }
}
