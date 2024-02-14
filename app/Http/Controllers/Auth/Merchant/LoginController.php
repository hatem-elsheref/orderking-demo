<?php

namespace App\Http\Controllers\Auth\Merchant;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::MERCHANT_HOME;

    private $isMerchantOwner = true;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->isMerchantOwner = config('is_merchant');
        $this->redirectTo = $this->isMerchantOwner ? RouteServiceProvider::MERCHANT_HOME : RouteServiceProvider::CUSTOMER_HOME;
    }


    public function showLoginForm()
    {
        $isMerchantOwner = $this->isMerchantOwner;
        return view('auth.merchant.login', compact('isMerchantOwner'));
    }

}
