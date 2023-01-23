<?php

namespace App\Types;

class AccessLevel
{
    const ACCOUNT_ACCESS_LEVEL_UNSPECIFIED = 0;
    const ACCOUNT_ACCESS_LEVEL_FULL_ACCESS = 1;
    const ACCOUNT_ACCESS_LEVEL_READ_ONLY = 2;
    const ACCOUNT_ACCESS_LEVEL_NO_ACCESS = 3;

    private const NAMES = [
        self::ACCOUNT_ACCESS_LEVEL_UNSPECIFIED => 'Уровень доступа не определён.',
        self::ACCOUNT_ACCESS_LEVEL_FULL_ACCESS => 'Полный доступ к счёту.',
        self::ACCOUNT_ACCESS_LEVEL_READ_ONLY => 'Доступ с уровнем прав "только чтение".',
        self::ACCOUNT_ACCESS_LEVEL_NO_ACCESS => 'Доступ отсутствует.',
    ];

    public static function getTranslateName($type): string
    {
        return self::NAMES[$type];
    }
}
