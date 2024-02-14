<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);

        if(!app()->isProduction()){
            $this->call(MerchantSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(OrderSeeder::class);
        }
    }
}
