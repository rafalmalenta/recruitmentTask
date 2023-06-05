<?php

namespace Renderer;

use Model\ExchangeHistory;
use Model\ExchangeRate;

class Renderer
{
    /** @param ExchangeRate[] $exchangeRates */
    public function renderTable(array $exchangeRates): void
    {
        $table = "<table style='position: relative; margin: auto;'>
            <thead>
                <td>name</td>
                <td>code</td>
                <td>ask</td>
                <td>bid</td>
            </thead>";
        foreach ($exchangeRates as $exchangeRate){
            $table .= "<tr style='border-bottom: 1pt solid black;'>";
            $table .= sprintf(
                "<td >%s</td><td>%s</td><td>%f</td><td>%f</td>",
                $exchangeRate->getName(),
                $exchangeRate->getCode(),
                $exchangeRate->getAsk(),
                $exchangeRate->getBid()
            );
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo $table;
    }

    /** @param ExchangeRate[] $exchangeRates */
    public function renderCurrencySelect(string $name, array $exchangeRates): void
    {
        $currencySelect = "<label for=\"$name\">Pick currency:</label>
        <select name=\"$name\" id=\"$name\">
            <option value=\"\">From</option>";
                foreach ($exchangeRates as $rate){
                    $currencySelect .= sprintf("<option value='%s' >%s</option>",$rate->getCode(), $rate->getCode());
                }

        $currencySelect .= "</select>";
        echo $currencySelect;
    }

    /** @param ExchangeHistory[] $exchangesHistory */
    public function renderExchangeHistory(array $exchangesHistory): void
    {
        $table = "<table style='position: relative; margin: auto;'>
            <thead>
                <td>exchanged amount</td>
                <td>from</td>
                <td>to</td>
                <td>amount received</td>
            </thead>";
        foreach ($exchangesHistory as $exchangeHistory){
            $table .= "<tr style='border-bottom: 1pt solid black;'>";
            $table .= sprintf(
                "<td >%.2f</td><td>%s</td><td>%s</td><td>%.2f</td>",
                $exchangeHistory->getOriginalAmount(),
                $exchangeHistory->getFromCurrency(),
                $exchangeHistory->getToCurrency(),
                $exchangeHistory->getAmountReceived()
            );
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo $table;
    }
}
