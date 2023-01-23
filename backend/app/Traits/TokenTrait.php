<?php

namespace App\Traits;

trait TokenTrait
{
    private static function getToken()
    {
        return env('TOKEN');
    }
}
