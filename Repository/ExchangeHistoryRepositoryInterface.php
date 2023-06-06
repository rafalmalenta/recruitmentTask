<?php

namespace Repository;

use Model\ExchangeHistoryInterface;

interface ExchangeHistoryRepositoryInterface
{
    public function save(ExchangeHistoryInterface $exchangeHistory): void;

    /** @return ExchangeHistoryInterface[] */
    public function getAll(): array;
}
