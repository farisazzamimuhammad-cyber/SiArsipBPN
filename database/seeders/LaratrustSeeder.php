<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class LaratrustSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Arsip
            'archives.view',
            'archives.preview',
            'archives.create',
            'archives.edit',
            'archives.delete',

            // Peminjaman
            'borrowings.view',
            'borrowings.create',
            'borrowings.cancel',

            // Persetujuan Kepala Kantor
            'borrowings.approve',
            'borrowings.reject',

            // Proses Petugas
            'borrowings.prepare',
            'borrowings.confirm',

            // Laporan
            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ROLE ADMIN
        |--------------------------------------------------------------------------
        */

        $admin = Role::firstOrCreate(
            ['name' => 'Admin'],
            [
                'display_name' => 'Administrator / Pimpinan',
                'description' => 'Mengelola sistem dan melakukan persetujuan peminjaman.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | ROLE STAFF
        |--------------------------------------------------------------------------
        */

        $staff = Role::firstOrCreate(
            ['name' => 'Staff'],
            [
                'display_name' => 'Petugas Arsip',
                'description' => 'Memproses dan menyiapkan arsip yang telah disetujui.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | ROLE USER
        |--------------------------------------------------------------------------
        */

        $userRole = Role::firstOrCreate(
            ['name' => 'User'],
            [
                'display_name' => 'Pemohon',
                'description' => 'Mengajukan dan melakukan peminjaman arsip.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | PERMISSION ADMIN
        |--------------------------------------------------------------------------
        */

        $admin->syncPermissions(
            Permission::all()
        );


        /*
        |--------------------------------------------------------------------------
        | PERMISSION STAFF
        |--------------------------------------------------------------------------
        */

        $staff->syncPermissions(
            Permission::whereIn('name', [

                'archives.view',
                'archives.preview',

                'borrowings.view',

                'borrowings.prepare',
                'borrowings.confirm',

            ])->get()
        );


        /*
        |--------------------------------------------------------------------------
        | PERMISSION USER / PEMOHON
        |--------------------------------------------------------------------------
        */

        $userRole->syncPermissions(
            Permission::whereIn('name', [

                'borrowings.view',
                'borrowings.create',
                'borrowings.cancel',

            ])->get()
        );


        /*
        |--------------------------------------------------------------------------
        | USER FARIS
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'email',
            'faris@gmail.com'
        )->first();

        if ($user) {

            $user->syncRoles([
                $userRole
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | KEPALA KANTOR
        |--------------------------------------------------------------------------
        */

        $pimpinan = User::where(
            'email',
            'pimpinan@gmail.com'
        )->first();

        if ($pimpinan) {

            $pimpinan->syncRoles([
                $admin
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | STAFF
        |--------------------------------------------------------------------------
        */

        $staffUser = User::where(
            'email',
            'staff@gmail.com'
        )->first();

        if ($staffUser) {

            $staffUser->syncRoles([
                $staff
            ]);
        }
    }
}