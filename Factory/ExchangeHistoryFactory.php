<?php

namespace Factory;

use Model\ExchangeHistory;
use Model\ExchangeHistoryInterface;

class ExchangeHistoryFactory implements ExchangeHistoryFactoryInterface
{
    public function createNew(float $originalAmount, string $fromCurrency, string $toCurrency, float $amount_received): ExchangeHistoryInterface
    {
        return new ExchangeHistory($originalAmount, $fromCurrency, $toCurrency, $amount_received);
    }
}
