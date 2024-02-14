<?php

namespace App\Http\Controllers\Merchant;


use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly UserService $userService)
    {
        // use permissions here
    }

    public function index() :View
    {
        $users = $this->userService->total();

        $orders = $this->orderService->total();

        return $this->view('home', compact('users', 'orders'));
    }

    public function customers() :View
    {
        $users = $this->userService->listingCustomers(5);

        return $this->view('users', compact('users'));
    }

    public function orders() :View
    {
        $orders = $this->orderService->paginate(5);

        return $this->view('home', compact('orders'));
    }
}
