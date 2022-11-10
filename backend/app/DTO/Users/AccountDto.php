<?php

namespace App\DTO\Users;

use App\Types\AccessLevel;
use App\Types\AccountStatus;
use App\Types\AccountType;

class AccountDto
{
    /**
     * @param string $name
     * @param string $email
     * @param array $roles
     * @param array $positions
     */
    public function __construct(array $fields)
    {
        $this->id = $fields['id'] ?? null;
        $this->type = $fields['type'] ?? null;
        $this->name = $fields['name'] ?? null;
        $this->status = $fields['status'] ?? null;
        $this->openedDate = $fields['openedDate'] ?? null;
        $this->closedDate = $fields['closedDate'] ?? null;
        $this->accessLevel = $fields['accessLevel'] ?? null;
    }

    public function toString()
    {
        $this->type = AccountType::getTranslateName($this->type);
        $this->status = AccountStatus::getTranslateName($this->status);
        $this->accessLevel = AccessLevel::getTranslateName($this->accessLevel);
        $this->openedDate = $this->openedDate->toDateTime()->format('Y-m-d H:i:s');
        $this->closedDate = $this->closedDate?->toDateTime()->format('Y-m-d H:i:s');
        return $this;
    }
}
