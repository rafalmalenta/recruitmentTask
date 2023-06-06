<?php

namespace Validator;

use Form\FormInterface;
use Model\ExchangeRateInterface;

class Validator
{
    private array $errors;
    private FormInterface $form;
    /**
     * @var ExchangeRateInterface[]
     */
    private array $exchangeRates;

    /** @param ExchangeRateInterface[] $exchangeRates */
    public function __construct(FormInterface $form, array $exchangeRates)
    {
        $this->form = $form;
        $this->exchangeRates = $exchangeRates;
    }

    public function isValid(): bool
    {
        $status = true;
        if($this->form->getAmount() <= 0){
            $this->errors[]= "Amount have to be positive";
            $status = false;
        }

        if(!is_numeric($this->form->getAmount())){
            $this->errors[]= "Amount is not a number";
            $status = false;
        }

        if(!$this->isInExchangeRates($this->form->getFromCode())){
            $this->errors[]= "The exchange currency is incorrect";
            $status = false;
        }

        if(!$this->isInExchangeRates($this->form->getToCode())){
            $this->errors[]= "The currency to be exchanged is invalid";
            $status = false;
        }

        return $status;
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

    public function printErrors(): void
    {
        foreach ($this->errors as $error){
            echo "<div style='text-align: center;background-color: red'>$error</div>";
        }
    }
}
