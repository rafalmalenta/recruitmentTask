<?php

namespace Form;

use Factory\ExchangeHistoryFactory;
use Factory\ExchangeHistoryFactoryInterface;
use Model\ExchangeHistory;
use Model\ExchangeHistoryInterface;
use Model\ExchangeRate;
use Model\ExchangeRateInterface;

class Form implements FormInterface
{
    private string $amount;
    private string $fromCode;
    private string $toCode;
    private ?array $errors;
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

    public function isValid(): bool
    {
        $status = true;
        if($this->amount <= 0){
            $this->errors[]= "Amount have to be positive";
            $status = false;
        }

        if(!is_numeric($this->amount)){
            $this->errors[]= "Amount is not a number";
            $status = false;
        }

        if(!$this->isInExchangeRates($this->fromCode)){
            $this->errors[]= "The exchange currency is incorrect";
            $status = false;
        }

        if(!$this->isInExchangeRates($this->toCode)){
            $this->errors[]= "The currency to be exchanged is invalid";
            $status = false;
        }

        return $status;
    }

    public function printErrors(): void
    {
        foreach ($this->errors as $error){
            echo "<div style='text-align: center;background-color: red'>$error</div>";
        }
    }

    public function exchange()
    {
        $from = $this->getExchangeRateByCode($this->fromCode);
        $to = $this->getExchangeRateByCode($this->toCode);

        $this->amountReceived = round($this->amountExchanged = $this->amount * $from->getBid()/ $to->getAsk(), 2);

    }

    public function getData(): ExchangeHistoryInterface
    {
        return $this->exchangeHistoryFactory->createNew($this->amount, $this->fromCode, $this->toCode, $this->amountReceived);
    }

    private function isInExchangeRates($code): bool
    {
        foreach ($this->exchangeRates as $exchangeRate){
            if($exchangeRate->getCode() === $code){
                return true;
            }
        }
        return false;
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
