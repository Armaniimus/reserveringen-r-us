<?php
// router
require_once 'Router/Router-v2.2.php';
require_once 'config.php';

// controllers (are dynamicly called)

// genericModels
require_once "Model/traits/ValidatePHP_ID-v2.0.php";
require_once 'Model/DataHandler-v4.0.php';
require_once 'Model/DataValidator-v4.0.php';
require_once 'Model/FileHandler-v2.0.php';
require_once 'Model/custom_HtmlElements-v2.0.php';
require_once 'Model/PhpUtilities-v3.0.php';
require_once 'Model/SessionModel-v2.0.php';
require_once 'Model/TemplatingSystem-v2.0.php';

// customModels


// Router and return
$Router = new Router(BESTAND_DIEPTE);
$echo = $Router->run();

// if router could find anything based on the url
if ($Router->error) {
    require_once 'Controller/Controller_main.php';
    $controller = new Controller_main();
    $echo = $controller->mydefault();
}

echo $echo;
echo $Router->errorMessage;
// print_r($Router->filteredPackets);
// print_r($_SESSION);
?>
