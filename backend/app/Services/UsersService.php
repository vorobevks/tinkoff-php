<?php

namespace App\Services;

use App\DTO\Users\AccountDto;
use Metaseller\TinkoffInvestApi2\ClientConnection;
use Tinkoff\Invest\V1\Account;
use Tinkoff\Invest\V1\GetAccountsRequest;
use Tinkoff\Invest\V1\UsersServiceClient;

class UsersService
{
    /**
     * @return AccountDto[]
     */
    public static function getAccounts(): array
    {
        $token = env('TOKEN');

        $userServiceClient = new UsersServiceClient(ClientConnection::getHostname(), ClientConnection::getOptions($token));

        list($response, $status) = $userServiceClient->GetAccounts(new GetAccountsRequest())->wait();

        $result = [];

        /** @var Account $account */
        foreach ($response->getAccounts() as $account) {
            $result[] = new AccountDto([
               'id' => $account->getId(),
               'type' => $account->getType(),
               'name' => $account->getName(),
               'status' => $account->getStatus(),
               'openedDate' => $account->getOpenedDate(),
               'closedDate' => $account->getClosedDate(),
               'accessLevel' => $account->getAccessLevel()
            ]);
        }

        return $result;
    }
}
