<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerRole = Role::query()->where(['name' => 'customer', 'is_core' => 1])->first();

        foreach (Merchant::query()->pluck('id')->toArray() as $merchant)
            User::factory()->count(100)->sequence(fn(Sequence $sequence) => [
                'name'        => sprintf('Customer %s', $sequence->index),
                'email'       => sprintf('customer%s@merchant%s.com', $sequence->index, $merchant),
                'role_id'     => $customerRole->id,
                'merchant_id' => $merchant
            ])->create();
    }
}
