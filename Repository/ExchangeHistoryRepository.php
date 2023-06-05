<?php

namespace Repository;

use Factory\ExchangeHistoryFactory;
use Form\Form;
use Model\ExchangeHistory;
use Model\ExchangeRate;
use PDO;

class ExchangeHistoryRepository
{
    private PDO $pdo;
    private ExchangeHistoryFactory $exchangeHistoryFactory;

    public function __construct(PDO $pdo, ExchangeHistoryFactory $exchangeHistoryFactory)
    {
        $this->pdo = $pdo;
        $this->exchangeHistoryFactory = $exchangeHistoryFactory;
    }

    public function save(ExchangeHistory $exchangeHistory): void
    {
        $insert = sprintf(
    "INSERT INTO exchange_history (original_amount, from_currency, to_currency, amount_received) VALUES (%f, '%s', '%s',%f)",
            $exchangeHistory->getOriginalAmount(),
            $exchangeHistory->getFromCurrency(),
            $exchangeHistory->getToCurrency(),
            $exchangeHistory->getAmountReceived()
        );

        try {
            $this->pdo->exec($insert);
        }catch (\PDOException $exception){
            die('Database connection failed'. $exception->getMessage());
        }
    }

    /** @return ExchangeHistory[] */
    public function getAll(): array
    {
        $sql = "SELECT original_amount, from_currency, to_currency, amount_received FROM exchange_history;";
        try {
            $exchangeRates = [];
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $exchangeRates[] = $this->exchangeHistoryFactory->createNew(
                    (float)$row['original_amount'],
                    $row['from_currency'],
                    $row['to_currency'],
                    (float)$row['amount_received']);
            }
            return $exchangeRates;
        }catch (\PDOException $exception){
            die('Database connection failed'. $exception->getMessage());
        }
    }
}
