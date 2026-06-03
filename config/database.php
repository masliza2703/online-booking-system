<?php
$privateConfig = __DIR__ . '/config.php';
$exampleConfig = __DIR__ . '/config.example.php';

if (file_exists($privateConfig)) {
    require_once $privateConfig;
    return;
}

require_once $exampleConfig;
