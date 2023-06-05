<?php

namespace Factory;

use Form\Form;

class FormFactory
{
    private ExchangeHistoryFactory $exchangeHistoryFactory;

    public function __construct(ExchangeHistoryFactory $exchangeHistoryFactory)
    {
        $this->exchangeHistoryFactory = $exchangeHistoryFactory;
    }

    public function createNew(string $amount, string $fromCode, string $toCode, array $exchangeRates): Form
    {
        return new Form($amount,  $fromCode, $toCode, $exchangeRates, $this->exchangeHistoryFactory);
    }
}
