<?php

namespace Model;

class ExchangeHistory
{
    private float $originalAmount;
    private string $fromCurrency;
    private string $toCurrency;
    private float $amount_received;

    public function __construct(float $originalAmount, string $fromCurrency, string $toCurrency, float $amount_received)
    {
        $this->originalAmount = $originalAmount;
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
        $this->amount_received = $amount_received;
    }

    public function getOriginalAmount(): float
    {
        return $this->originalAmount;
    }


    public function setOriginalAmount(float $originalAmount): void
    {
        $this->originalAmount = $originalAmount;
    }

    public function getFromCurrency(): string
    {
        return $this->fromCurrency;
    }


    public function setFromCurrency(string $fromCurrency): void
    {
        $this->fromCurrency = $fromCurrency;
    }

    public function getToCurrency(): string
    {
        return $this->toCurrency;
    }


    public function setToCurrency(string $toCurrency): void
    {
        $this->toCurrency = $toCurrency;
    }

    public function getAmountReceived(): float
    {
        return $this->amount_received;
    }

    public function setAmountReceived(float $amount_received): void
    {
        $this->amount_received = $amount_received;
    }
}
