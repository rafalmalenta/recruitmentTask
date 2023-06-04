<?php

namespace Services;

class APIHandler
{
    private string $NBPApi;
    private array $exchangeRates;

    public function __construct(string $NBPApi)
    {
        $this->NBPApi = $NBPApi;
    }

    public function fetchExchangeRates(): void
    {
        $ch = curl_init();
        $headers = ['Accept: application/json'];

        curl_setopt($ch, CURLOPT_URL, $this->NBPApi);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if(200 !== $httpcode){
           die("connection with API failed");
        }

        curl_close($ch);
        $this->exchangeRates = json_decode($response,true)[0]["rates"];
    }

    public function getExchangeRates(): ?array
    {
        return $this->exchangeRates;
    }
}
