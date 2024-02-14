<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermissions = Permission::query()->pluck('id')->toArray();

        $storePermissions = Permission::query()
            ->where('name', 'LIKE', '%_user')
            ->orWhere('name', 'LIKE', '%_order')
            ->orWhere('name', 'LIKE', '%_role')
            ->pluck('id')->toArray();

        $customerPermissions = Permission::query()->where('name', 'read_order')->pluck('id')->toArray();

        $adminRole = Role::query()->create([
            'name'    => 'super_admin',
            'is_core' => 1,
        ]);

        $storeRole = Role::query()->create([
            'name'    => 'store_admin',
            'is_core' => 1,

        ]);

        $customerRole = Role::query()->create([
            'name'    => 'customer',
            'is_core' => 1,

        ]);

        $adminRole->permissions()->attach($adminPermissions);
        $storeRole->permissions()->attach($storePermissions);
        $customerRole->permissions()->attach($customerPermissions);
    }
}
