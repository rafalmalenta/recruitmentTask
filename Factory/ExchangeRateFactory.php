<?php

namespace Factory;

use Model\ExchangeRate;
use Model\ExchangeRateInterface;

class ExchangeRateFactory implements ExchangeRateFactoryInterface
{
    public function createNew(string $name, string $code, float $bid, float $ask): ExchangeRateInterface
    {
        return new ExchangeRate($name, $code, $bid, $ask);
    }
    /** @return ExchangeRateInterface[] */
    public function createArray(array $rates): array
    {
        $exchangeRates = [];
        foreach ($rates as $rate){
            if($rate['code'] === "XDR"){
                continue;
            }

            $exchangeRates[] = new ExchangeRate($rate['currency'], $rate['code'], $rate['bid'], $rate['ask']);
        }

        return $exchangeRates;
    }
}
