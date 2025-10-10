<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',

            // Student Registration
            'pengajuan_view',
            'pengajuan_create',
            'pengajuan_edit',
            'pengajuan_delete',

            // Student Approval
            'approval_view',
            'approval_approve',
            'approval_reject',
            'approval_verify',

            // Financial
            'keuangan_view',
            'keuangan_manage',

            // Academic
            'akademik_view',
            'akademik_manage',

            // Dashboard
            'dashboard_view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::create(['name' => 'superadmin']);
        $superAdmin->givePermissionTo(Permission::all());

        $baak = Role::create(['name' => 'baak']);
        $baak->givePermissionTo([
            'dashboard_view',
            'pengajuan_view',
            'approval_view',
            'approval_approve',
            'approval_reject',
            'user_view',
        ]);

        $prodi = Role::create(['name' => 'prodi']);
        $prodi->givePermissionTo([
            'dashboard_view',
            'pengajuan_view',
            'approval_view',
            'approval_verify',
            'akademik_view',
        ]);

        $keuangan = Role::create(['name' => 'keuangan']);
        $keuangan->givePermissionTo([
            'dashboard_view',
            'keuangan_view',
            'keuangan_manage',
            'pengajuan_view',
        ]);

        $dosen = Role::create(['name' => 'dosen']);
        $dosen->givePermissionTo([
            'dashboard_view',
            'akademik_view',
        ]);

        $mahasiswa = Role::create(['name' => 'mahasiswa']);
        $mahasiswa->givePermissionTo([
            'dashboard_view',
            'pengajuan_create',
        ]);
    }
}
