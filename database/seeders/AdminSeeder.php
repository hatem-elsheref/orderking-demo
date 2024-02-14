<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name'        => 'Super Admin',
            'email'       => 'hatem@orderking.com',
            'password'    => Hash::make('Password!100'),
            'role_id'     => Role::query()->where([
                'name'    => 'super_admin',
                'is_core' => 1,
            ])->first()->id,
            'type'        => RoleType::ADMIN->value,
            'merchant_id' => null,
            'status'      => 1
        ]);
    }
}
