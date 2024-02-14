<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Merchant;
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

            Domain::query()->create([
                'domain'      => 'shop1',
                'merchant_id' => Merchant::query()->first()->id
            ]);

            Domain::query()->create([
                'domain'      => 'shop2',
                'merchant_id' => Merchant::query()->skip(1)->take(1)->first()->id
            ]);
        }
    }
}
