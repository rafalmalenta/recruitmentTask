<?php

namespace Renderer;

use Model\ExchangeHistory;
use Model\ExchangeHistoryInterface;
use Model\ExchangeRate;
use Model\ExchangeRateInterface;

interface RendererInterface
{
    /** @param ExchangeRateInterface[] $exchangeRates */
    public function renderTable(array $exchangeRates): void;

    /** @param ExchangeRateInterface[] $exchangeRates */
    public function renderCurrencySelect(string $name, array $exchangeRates): void;

    /** @param ExchangeHistoryInterface[] $exchangesHistory */
    public function renderExchangeHistory(array $exchangesHistory): void;
}
