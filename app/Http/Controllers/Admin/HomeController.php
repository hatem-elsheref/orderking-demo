<?php

namespace App\Http\Controllers\Admin;


use App\Enums\RoleType;
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
        $admins      = $this->userService->total(RoleType::ADMIN);
        $customers   = $this->userService->total(RoleType::CUSTOMER);
        $merchants   = $this->userService->total(RoleType::STORE);

        $orders = $this->orderService->total();

        return $this->view('home', compact('admins', 'customers', 'merchants', 'orders'));
    }

    public function customers() :View
    {
        $users = $this->userService->listingCustomers(5);

        return $this->view('users', compact('users'));
    }

    public function merchants() :View
    {
        $users = $this->userService->listingMerchants(5);

        return $this->view('merchants', compact('users'));
    }

    public function admins() :View
    {
        $users = $this->userService->listingAdmins(5);

        return $this->view('admins', compact('users'));
    }

    public function orders() :View
    {
        $orders = $this->orderService->paginate(5);

        return $this->view('home', compact('orders'));
    }
}
