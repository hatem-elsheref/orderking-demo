<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private function isAdmin() :bool
    {
        return is_null(config('merchant_id'));
    }
    protected function view($view, $data, $isAbsolute = false) :View
    {
        return $isAbsolute ? view($view, $data) : view(($this->isAdmin() ? 'dashboard.admin.' : 'dashboard.merchant.') . $view, $data);
    }
}
