<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Merchant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storeRole = Role::query()->where(['name' => 'store_admin', 'is_core' => 1])->first();

        User::factory()->count(2)->sequence(fn(Sequence $sequence) => [
            'name'        => sprintf('Merchant %s', $sequence->index),
            'email'       => sprintf('merchant%s@orderking.com', $sequence->index),
            'role_id'     => $storeRole->id,
            'merchant_id' => null,
            'type'        => RoleType::STORE->value,
        ])->create();

        foreach (User::query()->withoutGlobalScopes()->whereNull('merchant_id')->where('role_id', $storeRole->id)->where('type', RoleType::STORE->value)->pluck('id')->toArray() as  $owner)
            Merchant::factory()->create([
                'name'        => sprintf('Store %s', $owner),
                'owner_id'    => $owner,
            ]);

    }
}
