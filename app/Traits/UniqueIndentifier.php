<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UniqueIndentifier
{
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->code = (string) Str::uuid(); 
        });
    }  
}