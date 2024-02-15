<?php

namespace App\Console\Commands;

use App\Events\ApproveCustomer;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class RedisListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to Redis channels and perform actions';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        Redis::subscribe(['customer.approving'], function ($message) {
            $data = json_decode($message, true);
            User::query()->tenant()->where('id', $data['customer'])->update([
                'status' => 0
            ]);

            event(new ApproveCustomer($data));
        });
    }
}
