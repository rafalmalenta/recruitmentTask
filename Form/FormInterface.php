<?php

namespace Form;

use Model\ExchangeHistory;
use Model\ExchangeHistoryInterface;

interface FormInterface
{
    public function getAmount(): string;

    public function getFromCode(): string;

    public function getToCode(): string;

    public function getAmountReceived(): float;

    public function exchange();

    public function getData(): ExchangeHistoryInterface;
}
