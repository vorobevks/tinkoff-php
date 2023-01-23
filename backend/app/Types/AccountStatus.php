<?php

namespace App\Types;

class AccountStatus
{
    const ACCOUNT_STATUS_UNSPECIFIED = 0;
    const ACCOUNT_STATUS_NEW = 1;
    const ACCOUNT_STATUS_OPEN = 2;
    const ACCOUNT_STATUS_CLOSED = 3;

    private const NAMES = [
        self::ACCOUNT_STATUS_UNSPECIFIED => 'Статус счёта не определён.',
        self::ACCOUNT_STATUS_NEW => 'Новый, в процессе открытия.',
        self::ACCOUNT_STATUS_OPEN => 'Открытый и активный счёт.',
        self::ACCOUNT_STATUS_CLOSED => 'Закрытый счёт.',
    ];

    public static function getTranslateName($type): string
    {
        return self::NAMES[$type];
    }
}
