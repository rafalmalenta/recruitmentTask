<?php

namespace Factory;

use Form\Form;

interface FormFactoryInterface
{
    public function createNew(string $amount, string $fromCode, string $toCode, array $exchangeRates): Form;
}
