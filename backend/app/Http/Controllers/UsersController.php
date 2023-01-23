<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getAccounts()
    {
        $accounts = UsersService::getAccounts();
        return view('users.accounts', [
            'accounts' => collect($accounts)->map(function ($item) {
                return $item->toString();
            })
        ]);
    }
}
