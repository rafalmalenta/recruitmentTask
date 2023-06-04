<?php

namespace Factory;

use Model\ExchangeRate;

class ExchangeRateFactory
{
    public function createNew(string $name, string $code, float $bid, float $ask): ExchangeRate
    {
        return new ExchangeRate($name, $code, $bid, $ask);
    }
    /** @return ExchangeRate[] */
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
