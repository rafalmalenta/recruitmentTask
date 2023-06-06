<?php

namespace Factory;

use Model\ExchangeHistory;
use Model\ExchangeHistoryInterface;

interface ExchangeHistoryFactoryInterface
{
    public function createNew(float $originalAmount, string $fromCurrency, string $toCurrency, float $amount_received): ExchangeHistoryInterface;
}
