<?php

namespace Factory;

use Model\ExchangeHistory;

class ExchangeHistoryFactory
{
    public function createNew(float $originalAmount, string $fromCurrency, string $toCurrency, float $amount_received): ExchangeHistory
    {
        return new ExchangeHistory($originalAmount, $fromCurrency, $toCurrency, $amount_received);
    }
}
