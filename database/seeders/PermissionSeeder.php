<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'admin'     => ['r', 'c', 'd', 'u'],
            'setting'   => ['r', 'u'],
            'merchants' => ['r', 'c', 'd', 'u'],
            'user'      => ['r', 'd', 'u'],
            'role'      => ['r', 'c', 'd', 'u'],
            'order'     => ['r', 'd', 'u'],
        ];

        $mapper = [
            'r' => 'read',
            'c' => 'create',
            'd' => 'delete',
            'u' => 'update',
        ];

        $allPermissions = [];
        foreach ($models as $model => $permissions){
            foreach ($permissions as $permission){
                $allPermissions[] = [
                    'name'        => strtolower(sprintf('%s_%s', $mapper[$permission], $model)),
                    'description' => ucfirst(strtolower($mapper[$permission])) . ' ' . ucfirst(strtolower($model))
                ];
            }
        }

        Permission::query()->insert($allPermissions);
    }
}
