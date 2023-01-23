<?php

namespace App\DTO\Operations;

class PortfolioPositionDto
{
    const TRANSLATE_TYPES = [
        'share' => 'Акция',
        'etf' => 'Фонд',
        'bond' => 'Облигация',
        'currency' => 'Валюта',
    ];

    /**
     * Figi-идентификатора инструмента.
     * @var mixed|null
     */
    private mixed $figi;

    /**
     * @var mixed|null
     * Название инструмента
     */
    private mixed $name;

    /**
     * @var mixed|null
     * Тип инструмента.
     */
    private mixed $instrumentType;

    /**
     * @var mixed|null
     * Количество инструмента в портфеле в штуках.
     */
    private mixed $quantity;

    /**
     * @var mixed|null
     * Deprecated Количество лотов в портфеле.
     */
    private mixed $quantityLots;

    /**
     * @var mixed|null
     * Текущая цена за 1 инструмент. Для получения стоимости лота требуется умножить на лотность инструмента.
     */
    private mixed $currentPrice;

    /**
     * @var mixed|null
     * Валюта инструмента
     */
    private mixed $currency;

    public function __construct(array $fields)
    {
        $this->figi = $fields['figi'] ?? null;
        $this->name = $fields['name'] ?? null;
        $this->instrumentType = $fields['instrumentType'] ?? null;
        $this->quantity = $fields['quantity'] ?? null;
        $this->quantityLots = $fields['quantityLots'] ?? null;
        $this->currentPrice = $fields['currentPrice'] ?? null;
        $this->currency = $fields['currency'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getFigi(): mixed
    {
        return $this->figi;
    }

    /**
     * @param mixed $figi
     */
    public function setFigi(mixed $figi): void
    {
        $this->figi = $figi;
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
    public function getInstrumentType(): mixed
    {
        return self::TRANSLATE_TYPES[$this->instrumentType];
    }

    /**
     * @param mixed $instrumentType
     */
    public function setInstrumentType(mixed $instrumentType): void
    {
        $this->instrumentType = $instrumentType;
    }

    /**
     * @return mixed
     */
    public function getQuantity(): mixed
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity(mixed $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getQuantityLots(): mixed
    {
        return $this->quantityLots;
    }

    /**
     * @param mixed $quantityLots
     */
    public function setQuantityLots(mixed $quantityLots): void
    {
        $this->quantityLots = $quantityLots;
    }

    /**
     * @return mixed
     */
    public function getCurrentPrice(): mixed
    {
        return $this->currentPrice;
    }

    /**
     * @param mixed $currentPrice
     */
    public function setCurrentPrice(mixed $currentPrice): void
    {
        $this->currentPrice = $currentPrice;
    }

    /**
     * @return mixed
     */
    public function getCurrency(): mixed
    {
        return strtoupper($this->currency);
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency(mixed $currency): void
    {
        $this->currency = $currency;
    }

}
