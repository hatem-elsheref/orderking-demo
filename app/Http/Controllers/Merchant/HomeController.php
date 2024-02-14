<?php

namespace App\Http\Controllers\Merchant;


use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        return $this->view('users');
    }

    public function customersAjax(Request $request) :JsonResponse
    {
        $resource = $this->userService->listingAllCustomers($request);

        return response()->json([
            'draw'                 => intval($request->draw),
            'iTotalRecords'        => $resource['totalRecords'],
            'iTotalDisplayRecords' => $resource['totalRecordWithFilter'],
            'aaData'               => UserResource::collection($resource['data'])
        ]);
    }

    public function orders() :View
    {
        $orders = $this->orderService->paginate(5);

        return $this->view('orders', compact('orders'));
    }

    public function myAccount(Request $request) :View
    {
        $orders = $this->orderService->myOrders($request,5);
        $me = $request->user();
        return $this->view('account', compact('orders', 'me'));
    }
}
