<?php

namespace Model;

class ExchangeRate implements ExchangeRateInterface
{
    private string $name;
    private string $code;
    private float $bid;
    private float $ask;

    public function __construct(string $name, string $code, float $bid, float $ask)
    {
        $this->name = $name;
        $this->code = $code;
        $this->bid = $bid;
        $this->ask = $ask;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getBid(): float
    {
        return $this->bid;
    }

    public function setBid(float $bid): void
    {
        $this->bid = $bid;
    }

    public function getAsk(): float
    {
        return $this->ask;
    }

    public function setAsk(float $ask): void
    {
        $this->ask = $ask;
    }


}
