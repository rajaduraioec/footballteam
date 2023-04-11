<?php

namespace App\Traits;

trait CodeRouteBinder 
{
    public function getRouteKeyName()
    {
        return 'code';
    }
}