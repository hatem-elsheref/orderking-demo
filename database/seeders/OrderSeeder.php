<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Merchant::query()->pluck('id')->toArray() as $merchant) {
            $users = User::query()->where('merchant_id', $merchant)->where('type', RoleType::CUSTOMER->value)->inRandomOrder()->pluck('id')->toArray();
            foreach (range(1, 10) as $order){
                Order::query()->create([
                    'user_id'     => $users[rand(0, count($users) - 1)],
                    'merchant_id' => $merchant,
                    'status'      => 'new',
                    'description' => 'Order #' . $order . ' / ' . fake()->sentence,
                    'amount'      => fake()->randomNumber(10, 500),
                    'tax'         => fake()->randomNumber(1, 50)
                ]);
            }
        }

    }
}
