<?php

function relations(&$relations, $column) :void
{
    $parts = explode('.', $column, 2);

    $relationName = $parts[0];

    if (!isset($relations[$relationName])){
        $relations[$relationName] = [
            'columns'   => [],
            'relations' => [],
        ];
    }

    if (str($parts[1])->contains('.')){
        relations($relations[$relationName]['relations'], $parts[1]);
    }else{
        $relations[$relationName]['columns'][] = $parts[1];
    }

}


if (!function_exists('is_tenant')){
    function is_tenant():bool
    {
        return !is_null(config('merchant_id'));
    }
}
