<?php

if (!function_exists('is_tenant')){
    function is_tenant():bool
    {
        return !is_null(config('merchant_id'));
    }
}
