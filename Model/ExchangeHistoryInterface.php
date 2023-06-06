<?php

namespace Model;

interface ExchangeHistoryInterface
{
    public function getOriginalAmount(): float;

    public function setOriginalAmount(float $originalAmount): void;

    public function getFromCurrency(): string;

    public function setFromCurrency(string $fromCurrency): void;

    public function getToCurrency(): string;

    public function setToCurrency(string $toCurrency): void;

    public function getAmountReceived(): float;

    public function setAmountReceived(float $amount_received): void;
}
