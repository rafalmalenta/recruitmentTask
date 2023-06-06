<?php

namespace Model;

interface ExchangeRateInterface
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getCode(): string;

    public function setCode(string $code): void;

    public function getBid(): float;

    public function setBid(float $bid): void;

    public function getAsk(): float;

    public function setAsk(float $ask): void;
}
