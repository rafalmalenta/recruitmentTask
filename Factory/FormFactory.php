<?php

namespace Factory;

use Form\Form;

class FormFactory implements FormFactoryInterface
{
    private ExchangeHistoryFactory $exchangeHistoryFactory;

    public function __construct(ExchangeHistoryFactoryInterface $exchangeHistoryFactory)
    {
        $this->exchangeHistoryFactory = $exchangeHistoryFactory;
    }

    public function createNew(string $amount, string $fromCode, string $toCode, array $exchangeRates): Form
    {
        return new Form($amount,  $fromCode, $toCode, $exchangeRates, $this->exchangeHistoryFactory);
    }
}
