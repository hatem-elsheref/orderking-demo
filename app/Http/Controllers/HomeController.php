<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        // use permissions here
    }

    public function index()
    {
        $users  = User::query()->count();

        $orders = Order::query()->count();

        return view('dashboard.merchant.home', compact('users', 'orders'));
    }
}
