<?php

require __DIR__ . '/../vendor/autoload.php';

const VIEW_PATH = __DIR__ . '/../src/views';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$routes = new App\Routes;