<?php

namespace App\DTO\Users;

use App\Types\AccessLevel;
use App\Types\AccountStatus;
use App\Types\AccountType;



class AccountDto
{
    /**
     * @var mixed|null
     */
    private mixed $id;
    /**
     * @var mixed|null
     */
    private mixed $type;
    /**
     * @var mixed|null
     */
    private mixed $name;
    /**
     * @var mixed|null
     */
    private mixed $status;
    /**
     * @var mixed|null
     */
    private mixed $openedDate;
    /**
     * @var mixed|null
     */
    private mixed $closedDate;
    /**
     * @var mixed|null
     */
    private mixed $accessLevel;

    /**
     * @param array $fields
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

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType(): mixed
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType(mixed $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getName(): mixed
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(mixed $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStatus(): mixed
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus(mixed $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getOpenedDate(): mixed
    {
        return $this->openedDate;
    }

    /**
     * @param mixed $openedDate
     */
    public function setOpenedDate(mixed $openedDate): void
    {
        $this->openedDate = $openedDate;
    }

    /**
     * @return mixed
     */
    public function getClosedDate(): mixed
    {
        return $this->closedDate;
    }

    /**
     * @param mixed $closedDate
     */
    public function setClosedDate(mixed $closedDate): void
    {
        $this->closedDate = $closedDate;
    }

    /**
     * @return mixed
     */
    public function getAccessLevel(): mixed
    {
        return $this->accessLevel;
    }

    /**
     * @param mixed $accessLevel
     */
    public function setAccessLevel(mixed $accessLevel): void
    {
        $this->accessLevel = $accessLevel;
    }


}
