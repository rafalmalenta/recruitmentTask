<?php

namespace Factory;

use Model\ExchangeRate;
use Model\ExchangeRateInterface;

interface ExchangeRateFactoryInterface
{
    public function createNew(string $name, string $code, float $bid, float $ask): ExchangeRateInterface;

    /** @return ExchangeRateInterface[] */
    public function createArray(array $rates): array;
}
