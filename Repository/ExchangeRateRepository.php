<?php declare(strict_types=1);

namespace Repository;

use Factory\ExchangeRateFactory;
use Model\ExchangeRate;
use PDO;

class ExchangeRateRepository
{
    private PDO $pdo;
    private ExchangeRateFactory $factory;

    public function __construct(PDO $pdo, ExchangeRateFactory $factory)
    {
        $this->pdo = $pdo;
        $this->factory = $factory;
    }

    /** @param ExchangeRate[] $exchangeRates */
    public function saveAll(array $exchangeRates): void
    {
        $this->truncate();
        $insertMultiple = "INSERT INTO exchange_rates (name,code,bid,ask) VALUES ";
        foreach ($exchangeRates as $key=>$exchangeRate){
            $insertRow = sprintf("('%s', '%s', %f, %f)",
                $exchangeRate->getName(),
                $exchangeRate->getCode(),
                $exchangeRate->getAsk(),
                $exchangeRate->getBid()
            );
            if($key !== array_key_last($exchangeRates)){
                $insertRow .= ',';
            }

            $insertMultiple .=  $insertRow;
        }

        $insertMultiple .= ";";
        try {
            $this->pdo->exec($insertMultiple);
        }catch (\PDOException $exception){
            die('Database connection failed');
        }
    }

    /** @return ExchangeRate[] */
    public function getAll(): array
    {
        $sql = "SELECT name, code, bid, ask FROM exchange_rates;";
        try {
            $exchangeRates = [];
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $exchangeRates[] = $this->factory->createNew($row['name'], $row['code'], (float)$row['ask'], (float)$row['bid']);
            }
            return $exchangeRates;
        }catch (\PDOException $exception){
            die('Database connection failed'. $exception->getMessage());
        }
    }

    private function truncate(): void
    {
        $sql = "TRUNCATE TABLE exchange_rates";
        try {
            $this->pdo->exec($sql);
        }catch (\PDOException $exception){
            die('Database connection failed');
        }
    }
}
