<?php declare(strict_types=1);

namespace Services;

class Container
{
    private array $configuration;
    private \PDO $pdo;
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }
    public function getPDO(): \PDO
    {
        if (!null === $this->pdo) {
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
}
