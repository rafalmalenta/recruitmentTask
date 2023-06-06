<?php declare(strict_types=1);

require __DIR__.'/bootstrap.php';

use Services\Container;
use Validator\Validator;

$container = new Container($configuration);
$container->init();

$APIHandler = $container->getAPIHandler();
$exchangeRateRepository = $container->getExchangeRateRepository();
$exchangeHistoryRepository = $container->getExchangeHistoryRepository();

$exchangeRates = $APIHandler->fetchExchangeRates();
$exchangeRateRepository->saveAll($exchangeRates);

$exchangeHistory = $exchangeHistoryRepository->getAll();
$rates = $exchangeRateRepository->getAll();

$tableRenderer = $container->getRenderer();
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $formFactory = $container->getFormFactory();
    $form = $formFactory->createNew($_POST['amount'], $_POST['from'], $_POST['to'], $rates);
    $validator = new Validator($form, $exchangeRates);
    if ($validator->isValid()) {
        $form->exchange();
        $exchange = $form->getData();
        $exchangeHistoryRepository->save($exchange);

        echo "<meta http-equiv='refresh' content='0'>";
    } else {

        $validator->printErrors();
    }
}

?>

<html style="width: 100%;">
<?php $tableRenderer->renderTable($rates);?>

    <form method="POST" style="margin: auto;width: 50%;">
        <div style="text-align: center">Exchange currency</div>
        <input type="text" name="amount" placeholder="amount"/>

        <?php
            $tableRenderer->renderCurrencySelect("from", $rates);
            $tableRenderer->renderCurrencySelect("to", $rates);
        ?>

        <input type="submit" value="exchange">
    </form>
<?php
if(count($exchangeHistory) > 0){
    $tableRenderer->renderExchangeHistory($exchangeHistory);
    }
    ?>

</html>


