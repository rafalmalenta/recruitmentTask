<?php

namespace Repository;

use Model\ExchangeRateInterface;

interface ExchangeRateRepositoryInterface
{
    /** @param ExchangeRateInterface[] $exchangeRates */
    public function saveAll(array $exchangeRates): void;

    /** @return ExchangeRateInterface[] */
    public function getAll(): array;
}
