<?php declare(strict_types=1);

namespace Services;

use Factory\ExchangeHistoryFactory;
use Factory\ExchangeHistoryFactoryInterface;
use Factory\ExchangeRateFactory;
use Factory\ExchangeRateFactoryInterface;
use Factory\FormFactory;
use Factory\FormFactoryInterface;
use PDO;
use PDOException;
use Renderer\Renderer;
use Renderer\RendererInterface;
use Repository\ExchangeHistoryRepository;
use Repository\ExchangeHistoryRepositoryInterface;
use Repository\ExchangeRateRepository;
use Repository\ExchangeRateRepositoryInterface;

class Container
{
    private array $configuration;
    private ?PDO $pdo = null;
    private ?APIHandler $APIHandler = null;
    private ?ExchangeRateFactory $exchangeRateFactory = null;
    private ?ExchangeRateRepository $exchangeRateRepository = null;
    private ?ExchangeHistoryRepository $exchangeHistoryRepository = null;

    private ?ExchangeHistoryFactory $exchangeHistoryFactory = null;

    private ?FormFactory $formFactory = null;
    private ?Renderer $tableRenderer = null;
    private string $database;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function init(): void
    {
        $this->createDB('rectask');
        $this->createTables($this->getPDO());
    }

    public function getPDO(): PDO
    {
        if (null !== $this->pdo) {
            return $this->pdo;
        }

        try {
            $dsn = $this->configuration['db_dsn'].$this->database;
            $this->pdo = new PDO(
                $dsn,
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }catch (PDOException $exception){
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
    public function getExchangeRateFactory(): ExchangeRateFactoryInterface
    {
        if(null !== $this->exchangeRateFactory){
            return $this->exchangeRateFactory;
        }

        return $this->exchangeRateFactory = new ExchangeRateFactory();
    }

    public function getExchangeRateRepository(): ExchangeRateRepositoryInterface
    {
        if(null !== $this->exchangeRateRepository){
            return $this->exchangeRateRepository;
        }

        return $this->exchangeRateRepository = new ExchangeRateRepository($this->getPDO(), $this->getExchangeRateFactory());
    }

    public function getExchangeHistoryRepository(): ExchangeHistoryRepositoryInterface
    {
        if(null !== $this->exchangeHistoryRepository){
            return $this->exchangeHistoryRepository;
        }

        return $this->exchangeHistoryRepository = new ExchangeHistoryRepository($this->getPDO(), $this->getExchangeHistoryFactory());
    }

    public function getRenderer(): RendererInterface
    {
        if(null !== $this->tableRenderer){
            return $this->tableRenderer;
        }

        return $this->tableRenderer = new Renderer();
    }

    public function getExchangeHistoryFactory(): ExchangeHistoryFactoryInterface
    {
        if(null !== $this->exchangeHistoryFactory){
            return $this->exchangeHistoryFactory;
        }

        return $this->exchangeHistoryFactory = new ExchangeHistoryFactory();
    }

    public function getFormFactory(): FormFactoryInterface
    {
        if(null !== $this->formFactory){
            return $this->formFactory;
        }

        return $this->formFactory = new FormFactory($this->getExchangeHistoryFactory());
    }

    private function createDB(string $name): void
    {
        try {
            $pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbExist = "SHOW DATABASES LIKE '".$name."'";
            $result = $pdo->query($dbExist);
            if(count($result->fetchAll()) > 0){
                return;
            }

            $sql = "CREATE DATABASE $name IF NOT EXIST";
            $pdo->exec($sql);

        } catch (PDOException $exception){
            die($exception->getMessage());
        } finally
        {
            $this->database = "dbname=$name";
            $pdo = null;
        }
    }

    private function createTables(PDO $pdo): void
    {
        $exchangeRates = "create table IF NOT EXISTS exchange_rates
                (
                    id   int auto_increment
                        primary key,
                    name varchar(60) null,
                    code varchar(20) null,
                    ask  float       null,
                    bid  float       null
                    
                );";
        $exchangeHistory = "create table IF NOT EXISTS exchange_history
                (
                    id              int auto_increment
                        primary key,
                    original_amount float      not null,
                    from_currency   varchar(5) null,
                    to_currency     varchar(5) not null,
                    amount_received float      null                    
                );";
        try {
            $pdo->exec($exchangeRates);
            $pdo->exec($exchangeHistory);
        }catch (PDOException $exception){
            die($exception->getCode());
        }

    }
}
