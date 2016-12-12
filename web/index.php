<?php

session_start();

require __DIR__.'/../vendor/autoload.php';

use PHPRouter\Config;
use PHPRouter\Router;
    
$config = Config::loadFromFile(__DIR__.'/../app/config/router.yml');
$router = Router::parseConfig($config);
$route = $router->matchCurrentRequest();
