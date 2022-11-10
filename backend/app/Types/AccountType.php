<?php

namespace App\Types;

class AccountType
{
    const ACCOUNT_TYPE_UNSPECIFIED = 0;
    const ACCOUNT_TYPE_TINKOFF = 1;
    const ACCOUNT_TYPE_TINKOFF_IIS = 2;
    const ACCOUNT_TYPE_INVEST_BOX = 3;

    private const NAMES = [
        self::ACCOUNT_TYPE_UNSPECIFIED => 'Тип аккаунта не определён.',
        self::ACCOUNT_TYPE_TINKOFF => 'Брокерский счёт Тинькофф.',
        self::ACCOUNT_TYPE_TINKOFF_IIS => 'ИИС счёт.',
        self::ACCOUNT_TYPE_INVEST_BOX => 'Инвесткопилка.',
    ];

    public static function getTranslateName($type): string
    {
        return self::NAMES[$type];
    }
}
