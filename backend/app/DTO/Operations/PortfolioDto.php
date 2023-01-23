<?php

namespace App\DTO\Operations;

class PortfolioDto
{
    /**
     * Общая стоимость акций в портфеле в рублях.
     * @var mixed|null
     */
    private mixed $totalAmountShares;
    /**
     * Общая стоимость облигаций в портфеле в рублях.
     * @var mixed|null
     */
    private mixed $totalAmountBonds;
    /**
     * Общая стоимость фондов в портфеле в рублях.
     * @var mixed|null
     */
    private mixed $totalAmountEtf;
    /**
     * Общая стоимость валют в портфеле в рублях.
     * @var mixed|null
     */
    private mixed $totalAmountCurrencies;
    /**
     * Общая стоимость фьючерсов в портфеле в рублях.
     * @var mixed|null
     */
    private mixed $totalAmountFutures;
    /**
     * Текущая относительная доходность портфеля, в %.
     * @var mixed|null
     */
    private mixed $expectedYield;
    /**
     * Список позиций портфеля.
     * @var mixed|null
     */
    private mixed $positions;
    /**
     * Общая стоимость портфеля в рублях.
     * @var mixed|null
     */
    private mixed $totalAmount;

    public function __construct(array $fields)
    {
        $this->totalAmountShares = $fields['totalAmountShares'] ?? null;
        $this->totalAmountBonds = $fields['totalAmountBonds'] ?? null;
        $this->totalAmountEtf = $fields['totalAmountEtf'] ?? null;
        $this->totalAmountCurrencies = $fields['totalAmountCurrencies'] ?? null;
        $this->totalAmountFutures = $fields['totalAmountFutures'] ?? null;
        $this->expectedYield = $fields['expectedYield'] ?? null;
        $this->positions = $fields['positions'] ?? null;
        $this->totalAmount = $this->totalAmountShares
            + $this->totalAmountBonds
            + $this->totalAmountEtf
            + $this->totalAmountCurrencies
            + $this->totalAmountFutures;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountShares(): mixed
    {
        return $this->totalAmountShares;
    }

    /**
     * @param mixed $totalAmountShares
     */
    public function setTotalAmountShares(mixed $totalAmountShares): void
    {
        $this->totalAmountShares = $totalAmountShares;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountBonds(): mixed
    {
        return $this->totalAmountBonds;
    }

    /**
     * @param mixed $totalAmountBonds
     */
    public function setTotalAmountBonds(mixed $totalAmountBonds): void
    {
        $this->totalAmountBonds = $totalAmountBonds;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountEtf(): mixed
    {
        return $this->totalAmountEtf;
    }

    /**
     * @param mixed $totalAmountEtf
     */
    public function setTotalAmountEtf(mixed $totalAmountEtf): void
    {
        $this->totalAmountEtf = $totalAmountEtf;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountCurrencies(): mixed
    {
        return $this->totalAmountCurrencies;
    }

    /**
     * @param mixed $totalAmountCurrencies
     */
    public function setTotalAmountCurrencies(mixed $totalAmountCurrencies): void
    {
        $this->totalAmountCurrencies = $totalAmountCurrencies;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountFutures(): mixed
    {
        return $this->totalAmountFutures;
    }

    /**
     * @param mixed $totalAmountFutures
     */
    public function setTotalAmountFutures(mixed $totalAmountFutures): void
    {
        $this->totalAmountFutures = $totalAmountFutures;
    }

    /**
     * @return mixed
     */
    public function getExpectedYield(): mixed
    {
        return $this->expectedYield;
    }

    /**
     * @param mixed $expectedYield
     */
    public function setExpectedYield(mixed $expectedYield): void
    {
        $this->expectedYield = $expectedYield;
    }

    /**
     * @return mixed
     */
    public function getPositions(): mixed
    {
        return $this->positions;
    }

    /**
     * @param mixed $positions
     */
    public function setPositions(mixed $positions): void
    {
        $this->positions = $positions;
    }

    /**
     * @return mixed
     */
    public function getTotalAmount(): mixed
    {
        return $this->totalAmount;
    }

    /**
     * @param mixed $totalAmount
     */
    public function setTotalAmount(mixed $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }
}
