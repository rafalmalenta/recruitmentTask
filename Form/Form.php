<?php

namespace Form;

use Factory\ExchangeHistoryFactory;
use Factory\ExchangeHistoryFactoryInterface;
use Model\ExchangeHistoryInterface;
use Model\ExchangeRateInterface;

class Form implements FormInterface
{
    private string $amount;
    private string $fromCode;
    private string $toCode;
    private array $exchangeRates;
    private float $amountReceived;
    private ExchangeHistoryFactory $exchangeHistoryFactory;

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getFromCode(): string
    {
        return $this->fromCode;
    }

    public function getToCode(): string
    {
        return $this->toCode;
    }

    public function getAmountReceived(): float
    {
        return $this->amountReceived;
    }

    public function __construct(string $amount, string $fromCode, string $toCode, array $exchangeRates, ExchangeHistoryFactoryInterface $exchangeHistoryFactory)
    {
        $this->amount = $amount;
        $this->fromCode = $fromCode;
        $this->toCode = $toCode;
        $this->exchangeRates = $exchangeRates;
        $this->exchangeHistoryFactory = $exchangeHistoryFactory;
    }

    public function exchange()
    {
        $from = $this->getExchangeRateByCode($this->fromCode);
        $to = $this->getExchangeRateByCode($this->toCode);

        $this->amountReceived = round($this->amount * $from->getBid()/ $to->getAsk(), 2);
    }

    public function getData(): ExchangeHistoryInterface
    {
        return $this->exchangeHistoryFactory->createNew($this->amount, $this->fromCode, $this->toCode, $this->amountReceived);
    }

    private function getExchangeRateByCode(string $code): ?ExchangeRateInterface
    {
        foreach ($this->exchangeRates as $exchangeRate){
            if($exchangeRate->getCode() === $code){
                return $exchangeRate;
            }
        }
        return null;
    }
}
