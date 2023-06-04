<?php declare(strict_types=1);

require __DIR__.'/bootstrap.php';

use Services\Container;

$container = new Container($configuration);

$APIHandler = $container->getAPIHandler();
$exchangeRateRepository = $container->getExchangeRateRepository();

$ER = $APIHandler->fetchExchangeRates();
$exchangeRateRepository->saveAll($ER);

$rates = $exchangeRateRepository->getAll();

$tableRenderer = $container->getRenderer();


?>

<html style="width: 100%;">
<?php $tableRenderer->renderTable($rates);?>

    <form method="POST" style="margin: auto;width: 50%;">
        <input type="number" name="amount" placeholder="amount"/>

        <?php
            $tableRenderer->renderCurrencySelect("from", $rates);
            $tableRenderer->renderCurrencySelect("to", $rates);
        ?>

        <input type="submit" value="exchange">
    </form>

<?php
//    if($_SERVER['method'])
?>
</html>
