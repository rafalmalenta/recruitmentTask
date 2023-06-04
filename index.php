<?php declare(strict_types=1);

require __DIR__.'/bootstrap.php';

use Services\Container;

$container = new Container($configuration);

$APIHandler = $container->getAPIHandler();
$exchangeRateRepository = $container->getExchangeRateRepository();

$ER = $APIHandler->fetchExchangeRates();
$exchangeRateRepository->saveAll($ER);

$rates = $exchangeRateRepository->getAll();

