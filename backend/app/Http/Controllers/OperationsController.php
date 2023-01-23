<?php

namespace App\Http\Controllers;

use App\Services\OperationsService;

class OperationsController extends Controller
{
    public function getPortfolio($accountId)
    {
        $portfolio = OperationsService::getPortfolio($accountId);
        return view('users.account-detail', [
            'portfolio' => $portfolio
        ]);
    }
}
