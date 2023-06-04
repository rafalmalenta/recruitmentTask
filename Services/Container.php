<?php declare(strict_types=1);

namespace Services;

use Factory\ExchangeRateFactory;
use Repository\ExchangeRateRepository;

class Container
{
    private array $configuration;
    private ?\PDO $pdo = null;
    private ?APIHandler $APIHandler = null;
    private ?ExchangeRateFactory $exchangeRateFactory = null;
    private ?ExchangeRateRepository $exchangeRateRepository = null;
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }
    public function getPDO(): \PDO
    {
        if (null !== $this->pdo) {
            return $this->pdo;
        }

        try {
            $this->pdo = new \PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }catch (\PDOException $exception){
            die("connection failed ".$exception->getMessage());
        }
    }
    public function getAPIHandler(): APIHandler
    {
        if(null !== $this->APIHandler){
            return $this->APIHandler;
        }

        return $this->APIHandler = new APIHandler($this->configuration['NBPApi'], $this->getExchangeRateFactory());
    }
    public function getExchangeRateFactory(): ExchangeRateFactory
    {
        if(null !== $this->exchangeRateFactory){
            return $this->exchangeRateFactory;
        }

        return $this->exchangeRateFactory = new ExchangeRateFactory();
    }

    public function getExchangeRateRepository(): ExchangeRateRepository
    {
        if(null !== $this->exchangeRateRepository){
            return $this->exchangeRateRepository;
        }

        return $this->exchangeRateRepository = new ExchangeRateRepository($this->getPDO(), $this->getExchangeRateFactory());
    }
}
